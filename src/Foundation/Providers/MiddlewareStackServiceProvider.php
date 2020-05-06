<?php
namespace Jan\Foundation\Providers;


use Jan\Component\DependencyInjection\ServiceProvider\AbstractServiceProvider;
use Jan\Component\Http\Middleware\MiddlewareStack;

/**
 * Class MiddlewareStackServiceProvider
 * @package Jan\Foundation\Providers
 */
class MiddlewareStackServiceProvider extends AbstractServiceProvider
{

    /**
     * @return mixed
    */
    public function register()
    {
        $this->container->singleton('middlewareStack', function () {

            $middlewareStack = $this->container->make(MiddlewareStack::class);

            return $middlewareStack;
        });
    }
}