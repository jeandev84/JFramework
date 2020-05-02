<?php
namespace App\Providers;


use Jan\Component\DependencyInjection\Contracts\BootableServiceProvider;
use Jan\Component\DependencyInjection\ServiceProvider\AbstractServiceProvider;

/**
 * Class FileSystemServiceProvider
 * @package App\Providers
*/
class FileSystemServiceProvider extends AbstractServiceProvider implements BootableServiceProvider
{

    /**
     * @return mixed
    */
    public function register()
    {
        echo __METHOD__." run! <br>";
    }

    /**
     * @return mixed
     */
    public function boot()
    {
        echo __METHOD__." Run First! <br>";
    }
}