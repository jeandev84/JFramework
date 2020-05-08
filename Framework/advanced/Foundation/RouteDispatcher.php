<?php
namespace Jan\Foundation;


use Jan\Component\DependencyInjection\Contracts\ContainerInterface;
use Jan\Component\Http\Message\RequestInterface;
use Jan\Component\Http\Message\ResponseInterface;
use Jan\Component\Http\Middleware\MiddlewareStack;
use Jan\Component\Routing\Route;
use Jan\Component\Routing\RouteParam;
use ReflectionException;
use ReflectionMethod;


/**
 * Class RouteDispatcher
 * @package Jan\Foundation
*/
class RouteDispatcher
{

     /** @var string  */
     protected $controllerPrefix = 'App\\Controllers\\';


     /** @var RouteParam  */
     protected $route;


     /** @var ContainerInterface */
     protected $container;


     /** @var array  */
     protected $routeMiddlewares;


     /**
      * RouteDispatcher constructor.
      * @param RouteParam $route
     */
     public function __construct(RouteParam $route)
     {
         $this->route = $route;
         $this->routeMiddlewares = $route->getMiddlewares();
     }


     /**
      * @param ContainerInterface $container
      * @return RouteDispatcher
     */
     public function setContainer(ContainerInterface $container)
     {
           $this->container = $container;

           return $this;
     }


     /**
      * @param array $middlewares
      * @return RouteDispatcher
     */
     public function addMiddlewares(array $middlewares = [])
     {
         $this->routeMiddlewares = array_merge($this->routeMiddlewares, $middlewares);

         return $this;
     }


     /**
      * @return mixed
     */
     public function getResponse()
     {
         return $this->container->get(ResponseInterface::class);
     }


     /**
      * @return ResponseInterface
      * @throws ReflectionException
     */
     public function callAction(): ResponseInterface
     {
         // Run middlewares
         $response = $this->runStackRouteMiddlewares();

         if(! $response instanceof ResponseInterface)
         {
             $response = $this->getResponse();
         }

         $target = $this->route->getTarget();
         $body = null;

         if($target instanceof \Closure)
         {
             $body = call_user_func($target, $this->route->getMatches());
         }

         if(is_array($target) && ($callback = $this->route->getControllerAndAction()))
         {
             $body = $this->getActionCallback($callback);
         }

         if(is_string($body))
         {
             $response->withBody($body);
         }

         if(is_array($body))
         {
             $response->withBody(json_encode($body));
         }

         if($body instanceof ResponseInterface)
         {
             return $body;
         }

         return $response;
     }


     /**
      * @param array $callback
      * @return ResponseInterface
      * @throws ReflectionException
     */
     private function getActionCallback(array $callback): ResponseInterface
     {
         list($controllerClass, $action) = $callback;
         $controllerClass = sprintf('%s%s', $this->controllerPrefix, $controllerClass);
         $controllerObjectResolved = $this->container->get($controllerClass);
         $controllerObjectResolved->setContainer($this->container);

         if(method_exists($controllerObjectResolved, $action))
         {
             $reflectedMethod = new ReflectionMethod($controllerClass, $action);
             $methodParams = $this->resolveActionParams($reflectedMethod);

             $response =  call_user_func_array([$controllerObjectResolved, $action], $methodParams);

             /*
             if(! $response instanceof ResponseInterface)
             {
                 exit(
                     sprintf('Method (%s) of controller (%s) must to return instance of Response',
                     $controllerClass,
                     $action
                     )
                 );
             }
             */

             return $response;
         }
     }


     /**
      * @param ReflectionMethod $reflectionMethod
      * @return mixed
     */
     protected function resolveActionParams(ReflectionMethod $reflectionMethod)
     {
         return $this->container->resolveMethodDependencies($reflectionMethod, $this->route->getMatches());
     }


     /**
       * @return mixed
     */
     private function runStackRouteMiddlewares()
     {
         $middlewareStack = $this->container->get(MiddlewareStack::class);
         if($middlewares = $this->routeMiddlewares)
         {
             foreach ($middlewares as $middleware)
             {
                 $middlewareInstance = $this->container->get($middleware);
                 $middlewareStack->add($middlewareInstance);
             }
         }

         $request = $this->container->get(RequestInterface::class);
         $response = $this->container->get(ResponseInterface::class);

         return $middlewareStack->handle($request, $response);
     }

}