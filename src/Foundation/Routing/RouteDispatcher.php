<?php
namespace Jan\Foundation\Routing;


use Jan\Component\DependencyInjection\Contracts\ContainerInterface;
use Jan\Component\Http\Message\ResponseInterface;
use Jan\Component\Routing\Route;
use Jan\Component\Routing\RouteParam;
use ReflectionException;
use ReflectionMethod;


/**
 * Class RouteDispatcher
 * @package Jan\Foundation\Routing
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
     protected $middlewareStack = [];


     /**
      * RouteDispatcher constructor.
      * @param RouteParam $route
     */
     public function __construct(RouteParam $route)
     {
         $this->route = $route;
         $this->middlewareStack = $route->getMiddlewares();
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
     public function addMiddlewares(array $middlewares)
     {
         $this->middlewareStack = array_merge($this->middlewareStack, $middlewares);

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
         // TODO add callback middlewares before calling each action


         // Get response
         $response = $this->getResponse();
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

             if(! $response instanceof ResponseInterface)
             {
                 exit(
                     sprintf('Method (%s) of controller (%s) must to return instance of Response',
                     $controllerClass,
                     $action
                     )
                 );
             }

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
      * @param array $middlewares
     */
     private function runStackRouteMiddlewares(array $middlewares)
     {
           //
     }

}