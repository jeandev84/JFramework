<?php
namespace Jan\Foundation\Providers;


use Jan\Component\DependencyInjection\Contracts\BootableServiceProvider;
use Jan\Component\DependencyInjection\ServiceProvider\AbstractServiceProvider;
use Jan\Component\FileSystem\FileSystem;
use Jan\Component\Routing\Route;
use Jan\Component\Routing\Router;


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
    }


    /**
     * @return mixed
    */
    public function register()
    {
        // router
        $this->container->singleton('router', function () {
            $router = new Router(Route::collections());
            $router->addPatterns(Route::patterns());
            $router->addMiddlewares(Route::middlewares());
            return $router;
        });
    }

}