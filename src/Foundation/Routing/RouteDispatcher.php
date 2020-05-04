<?php
namespace Jan\Foundation\Routing;


use Jan\Component\DependencyInjection\Contracts\ContainerInterface;
use Jan\Component\Http\Message\ResponseInterface;
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


     /**
      * RouteDispatcher constructor.
      * @param RouteParam $route
     */
     public function __construct(RouteParam $route)
     {
         $this->route = $route;
         dump($route);
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
      * @return mixed
     */
     public function getResponse()
     {
         return $this->container->get(ResponseInterface::class);
     }


     /**
      * Call route action
     */
     public function callAction()
     {
         $response = $this->getResponse();
         $target = $this->route->getTarget();
         $body = null;

         if($target instanceof \Closure)
         {
             $body = call_user_func($target, []);
         }

         if(is_array($target) && ($callback = $this->route->getControllerAndAction()))
         {
             $body = $this->getActionCallback($callback);
         }

         if(is_string($body))
         {
             $response->withBody($body);
         }

         if($body instanceof ResponseInterface)
         {
             return $response;
         }

         return $response;
     }


     /**
      * @param array $callback
      * @return string
      * @throws ReflectionException
     */
     private function getActionCallback(array $callback)
     {
         list($controllerClass, $action) = $callback;
         $controllerClass = sprintf('%s%s', $this->controllerPrefix, $controllerClass);
         $controllerObjectResolved = $this->container->get($controllerClass);

         if(method_exists($controllerObjectResolved, $action))
         {
             $reflectedMethod = new ReflectionMethod($controllerClass, $action);
             $methodParams = $this->container->resolveMethodDependencies(
                 $reflectedMethod,
                 $this->route->getMatches()
             );

             $respond =  call_user_func_array([$controllerObjectResolved, $action], $methodParams);

             if(! $respond instanceof ResponseInterface)
             {
                 exit(
                     sprintf('Method (%s) of controller (%s) must to return instance of Response',
                     $controllerClass,
                     $action
                     )
                 );
             }
         }
     }


     /**
     * @throws \Exception
     */
     protected function logicUsable()
     {

         $router = new \Jan\Component\Routing\Router(
             \Jan\Component\Routing\Route::collections()
         );
         $router->addPatterns(\Jan\Component\Routing\Route::patterns())
                ->addMiddlewares(\Jan\Component\Routing\Route::middlewares());

         $route = $router->match($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);

         if(! $route)
         {
             dump('Route not found!');
             die;
         }

         echo "<h3>Current route Param</h3>";
         dump($route);

         echo '<h3>Response</h3>';
         call_user_func($route['target'], $route['matches']);

         echo "<h3>Route collections</h3>";
         dump(Route::collections());
         //dump(\Jan\Component\Routing\Route::namedRoutes());

     }
}