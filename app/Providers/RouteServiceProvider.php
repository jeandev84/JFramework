<?php
namespace App\Providers;


use Jan\Component\DependencyInjection\Contracts\BootableServiceProvider;
use Jan\Component\DependencyInjection\ServiceProvider\AbstractServiceProvider;
use Jan\Component\Routing\Route;
use Jan\Component\Routing\Router;

//TODO change and set it in core alias dependency injection
class_alias('Jan\\Component\\Routing\\Route', 'Route');

/**
 * Class RouteServiceProvider
 * @package App\Providers
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
        $container->get('fileSystem')->load('/routes/web.php');
        $container->get('fileSystem')->load('/routes/api.php');
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
            return $router;
        });
    }

}