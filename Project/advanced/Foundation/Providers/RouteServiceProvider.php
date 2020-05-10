<?php
namespace Jan\Foundation\Providers;


use Jan\Component\DependencyInjection\Contracts\BootableServiceProvider;
use Jan\Component\DependencyInjection\ServiceProvider\AbstractServiceProvider;
use Jan\Component\Http\Message\RequestInterface;
use Jan\Component\Routing\Route;
use Jan\Component\Routing\RouteParam;
use Jan\Component\Routing\Router;
use Jan\Foundation\Loader;
use Jan\Foundation\RouteDispatcher;


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
        $this->container[Loader::class]->loadRouteResources();

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

            $router = $this->container->get('router');
            $route = $router->match($request->getMethod(), $request->getUri());
            $dispatcher = new RouteDispatcher(new RouteParam($route));

            # namespace already defined by default
            # can set new namespace for changes
            /* $dispatcher->withControllerNamespace('App\\Controllers\\'); */

            $dispatcher->setContainer($this->container);

            return $dispatcher;
        });
    }

}