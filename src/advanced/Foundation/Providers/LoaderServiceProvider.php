<?php
namespace Jan\Foundation\Providers;


use Jan\Component\DI\ServiceProvider\AbstractServiceProvider;
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
        $this->container->singleton('loader', function () {
            return new Loader($this->container);
        });

        $loader = $this->container->get('loader');
        $loader->loadNamespaceAlias();
    }
}