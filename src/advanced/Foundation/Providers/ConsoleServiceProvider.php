<?php
namespace Jan\Foundation\Providers;


use Jan\Component\Console\Console;
use Jan\Component\Console\ConsoleInterface;
use Jan\Component\DependencyInjection\ServiceProvider\AbstractServiceProvider;



/**
 * Class ConsoleServiceProvider
 * @package Jan\Foundation\Providers
*/
class ConsoleServiceProvider extends AbstractServiceProvider
{

    /**
     * @return mixed
    */
    public function register()
    {
        $this->container->singleton(ConsoleInterface::class, function () {
             return new Console();
        });
    }

}