<?php
namespace Jan\Foundation\Providers;


use Jan\Component\Config\Config;
use Jan\Component\DependencyInjection\Contracts\BootableServiceProvider;
use Jan\Component\DependencyInjection\ServiceProvider\AbstractServiceProvider;


/**
 * Class ConfigurationServiceProvider
 * @package Jan\Foundation\Providers
*/
class ConfigurationServiceProvider extends AbstractServiceProvider implements BootableServiceProvider
{

    /** @var array  */
    private $config = [];


    /**
     * @return mixed
    */
    public function boot()
    {

    }


    /**
     * @return mixed
    */
    public function register()
    {
        $this->container->singleton(Config::class, function () {
             $config = new Config();
        });
    }
}