<?php
namespace Jan\Foundation\Providers;


use Jan\Component\DependencyInjection\ServiceProvider\AbstractServiceProvider;
use Jan\Foundation\Loader;

/**
 * Class LoaderServiceProvider
 * @package Jan\Foundation\Providers
*/
class LoaderServiceProvider extends AbstractServiceProvider
{

    /**
     * @return mixed
    */
    public function register()
    {
        $this->container->singleton(Loader::class, function () {

            return new Loader($this->container);
        });
    }
}