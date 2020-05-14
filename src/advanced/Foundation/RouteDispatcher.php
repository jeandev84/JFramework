<?php
namespace Jan\Foundation;


use Jan\Component\DI\Contracts\ContainerInterface;
use Jan\Component\Http\Message\RequestInterface;
use Jan\Component\Http\Message\ResponseInterface;
use Jan\Component\Routing\RouteParam;
use Jan\Foundation\Exceptions\RouteDispatcherException;
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
     protected $middlewareStorage = [];


     /**
      * RouteDispatcher constructor.
      * @param RouteParam $route
     */
     public function __construct(RouteParam $route)
     {
          $this->route = $route;
     }



     /**
      * @param string $namespace
      * @return RouteDispatcher
     */
     public function withControllerNamespace(string $namespace)
     {
          $this->controllerPrefix = rtrim($namespace, '\\') .'\\';

          return $this;
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
         $this->middlewareStorage = array_merge(
             $this->route->getMiddlewares(),
             $middlewares
         );

         return $this;
     }


     /**
      * @return ResponseInterface
      * @throws ReflectionException
     */
     public function callAction(): ResponseInterface
     {
         // Run all stack middlewares of application
         $response = $this->runStackRouteMiddlewares();

         // Get Response
         if(! $response instanceof ResponseInterface)
         {
             $response = $this->getResponse();
         }

         return $this->resolveBody($response, $this->getBody());
     }


    /**
     * @param ResponseInterface $response
     * @param $body
     * @return ResponseInterface
    */
    public function resolveBody(ResponseInterface $response, $body): ResponseInterface
    {
        if(is_array($body))
        {
            $body = json_encode($body);
        }

        if($body instanceof ResponseInterface)
        {
            return $body;

        }

        $response->withBody((string) $body);

        return $response;
    }


     /**
      * @param array $callback
      * @return ResponseInterface
      * @throws ReflectionException|RouteDispatcherException
      */
     private function getActionCallback(array $callback)
     {
         list($controllerClass, $action) = $callback;
         $controllerClass = sprintf('%s%s', $this->controllerPrefix, $controllerClass);

         if(! class_exists($controllerClass))
         {
              throw new RouteDispatcherException(
                  sprintf('Class (%s) does not exist!', $controllerClass)
              , 404);
         }

         $controllerObjectResolved = $this->container->get($controllerClass);
         $controllerObjectResolved->setContainer($this->container);

         if(method_exists($controllerObjectResolved, $action))
         {
             $reflectedMethod = new ReflectionMethod($controllerClass, $action);
             $methodParams = $this->resolveActionParams($reflectedMethod);
             $response = call_user_func_array([$controllerObjectResolved, $action], $methodParams);

             if(! $response instanceof ResponseInterface)
             {
                 throw new RouteDispatcherException(
                     sprintf('%s::%s must return instance of ResponseInterface',
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
         return $this->container->resolveMethodDependencies(
             $reflectionMethod,
             $this->route->getMatches()
         );
     }


     /**
      * Get current body
      * @throws ReflectionException
      * @throws RouteDispatcherException
     */
     private function getBody()
     {
         $body = null;
         $target = $this->route->getTarget();

         if(is_null($target))
         {
             $controller = $this->container->get(DefaultController::class);
             $target = call_user_func([$controller, 'index']);
         }

         if($target instanceof \Closure)
         {
             $body = call_user_func($target, $this->route->getMatches());
         }

         if(is_array($target) && ($callback = $this->route->getControllerAndAction()))
         {
             $body = $this->getActionCallback($callback);
         }

         return $body;
     }


     /**
       * @return mixed
     */
     protected function runStackRouteMiddlewares()
     {
         $middlewareStack = $this->container->get('middleware');
         if($middlewares = $this->middlewareStorage)
         {
             foreach ($middlewares as $middleware)
             {
                 $middlewareInstance = $this->container->get($middleware);
                 $middlewareStack->add($middlewareInstance);
             }
         }

         return $middlewareStack->handle($this->getRequest(), $this->getResponse());
     }


     /**
      * Get request
      * @return mixed
     */
     private function getRequest()
     {
         return $this->container->get(RequestInterface::class);
     }

    /**
     * Get response
     * @return mixed
    */
    private function getResponse()
    {
        return $this->container->get(ResponseInterface::class);
    }

}