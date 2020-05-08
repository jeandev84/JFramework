<?php
namespace Jan\Foundation\Providers;


use Jan\Component\DependencyInjection\Contracts\BootableServiceProvider;
use Jan\Component\DependencyInjection\ServiceProvider\AbstractServiceProvider;
use Jan\Component\FileSystem\FileSystem;
use Jan\Component\Http\Message\RequestInterface;
use Jan\Component\Routing\Route;
use Jan\Component\Routing\RouteParam;
use Jan\Component\Routing\Router;
use Jan\Foundation\RouteDispatcher;


//TODO change and set it in core alias dependency injection
class_alias('Jan\\Component\\Routing\\Route', 'Route');

/**
 * Class RouteServiceProvider
 * @package Jan\Foundation\Providers
*/
class RouteServiceProvider extends AbstractServiceProvider implements BootableServiceProvider
{

    /*
    public $provides = [
      'example',
      'test'
    ];
    */

    /**
     * @return mixed
    */
    public function boot()
    {
        $container = $this->getContainer();

        // Load route of application
        $container->get(FileSystem::class)->load('/routes/web.php');
        $container->get(FileSystem::class)->load('/routes/api.php');

        // router
        $this->container->singleton('router', function () {
            $router = new Router(Route::collections());
            $router->addPatterns(Route::patterns());
            $router->addMiddlewares(Route::middlewares());
            return $router;
        });
    }


    /**
     * @return mixed
    */
    public function register()
    {
        $request = $this->container->get(RequestInterface::class);

        $this->container->singleton(RouteDispatcher::class, function () use($request) {

            // TODO implement create a service provider for Dispatching route
            // and call this service here like :
            // $response = $this->container->get(RouteDispatcher::class);
            /* $router = $this->container['router']; */
            $router = $this->container->get('router');
            $route = $router->match($request->getMethod(), $request->getUri());
            $dispatcher = new RouteDispatcher(new RouteParam($route));

            // Can define controller namespace prefix
            /* $dispactcher->namespace('App\\Controllers\\'); */

            // To add stack merge middlewares
            $dispatcher->setContainer($this->container);

            return $dispatcher;
        });
    }

}