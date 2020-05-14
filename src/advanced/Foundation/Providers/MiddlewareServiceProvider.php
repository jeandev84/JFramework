<?php
namespace Jan\Foundation\Providers;


use Jan\Component\DI\ServiceProvider\AbstractServiceProvider;
use Jan\Component\Http\Middleware\MiddlewareStack;

/**
 * Class MiddlewareServiceProvider
 * @package Jan\Foundation\Providers
*/
class MiddlewareServiceProvider extends AbstractServiceProvider
{


    /**
     * @return mixed
    */
    public function register()
    {
         $this->container->singleton('middleware', function () {
             return new MiddlewareStack();
         });
    }
}