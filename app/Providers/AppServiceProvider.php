<?php
namespace App\Providers;


use Jan\Component\DependencyInjection\Contracts\BootableServiceProvider;
use Jan\Component\DependencyInjection\ServiceProvider\AbstractServiceProvider;

/**
 * Class AppServiceProvider
 * @package App\Providers
*/
class AppServiceProvider extends AbstractServiceProvider implements BootableServiceProvider
{

    /**
     * @return mixed
    */
    public function register()
    {
        // dump($this->getContainer());
         echo __METHOD__." run! <br>";
    }

    /**
     * @return mixed
    */
    public function boot()
    {
        echo __METHOD__." run First ! <br>";
    }
}