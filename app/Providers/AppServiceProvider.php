<?php
namespace App\Providers;


use Jan\Component\DependencyInjection\Contracts\BootableServiceProvider;
use Jan\Component\DependencyInjection\ServiceProvider\AbstractServiceProvider;
use Jan\Component\FileSystem\FileSystem;
use Jan\Component\Http\Contract\RequestInterface;
use Jan\Component\Http\Contract\ResponseInterface;
use Jan\Component\Http\Request;
use Jan\Component\Http\Response;

/**
 * Class AppServiceProvider
 * @package App\Providers
*/
class AppServiceProvider extends AbstractServiceProvider implements BootableServiceProvider
{
    /**
     * @return mixed
    */
    public function boot()
    {
         //
    }


    /**
     * @return mixed
    */
    public function register()
    {
        /* $container = $this->getContainer(); */

        // File System
        $this->container->singleton('fileSystem', function () {
            return new FileSystem($this->container->get('base.path'));
        });


        // Bind Request interface
        $this->container->singleton(RequestInterface::class, function () {
            return new Request();
        });

        // Bind Response interface
        $this->container->singleton(ResponseInterface::class, function () {
            return new Response();
        });
    }

}