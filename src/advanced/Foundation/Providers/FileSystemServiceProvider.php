<?php
namespace Jan\Foundation\Providers;


use Jan\Component\DI\ServiceProvider\AbstractServiceProvider;
use Jan\Component\FileSystem\FileSystem;


/**
 * Class FileSystemServiceProvider
 * @package Jan\Foundation\Providers
*/
class FileSystemServiceProvider extends AbstractServiceProvider
{

    /**
     * @return mixed
     */
    public function register()
    {
        // File System
        $this->container->singleton(FileSystem::class, function () {
            return new FileSystem($this->container->get('base.path'));
        });

    }
}