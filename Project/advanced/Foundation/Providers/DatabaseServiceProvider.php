<?php
namespace Jan\Foundation\Providers;


use Jan\Component\Database\Connection;
use Jan\Component\Database\Contracts\QueryManagerInterface;
use Jan\Component\Database\Statement;
use Jan\Component\DependencyInjection\Contracts\BootableServiceProvider;
use Jan\Component\DependencyInjection\ServiceProvider\AbstractServiceProvider;
use Jan\Component\FileSystem\FileSystem;

/**
 * Class DatabaseServiceProvider
 * @package Jan\Foundation\Providers
*/
class DatabaseServiceProvider extends AbstractServiceProvider implements BootableServiceProvider
{

    /**
     * @return mixed
     */
    public function boot()
    {
        // TODO: Implement boot() method.
    }

    /**
     * @return mixed
    */
    public function register()
    {
        $this->container->singleton(Connection::class, function () {
            $filesystem = $this->container->get(FileSystem::class);
            $config = $filesystem->load('config/database.php');
            return Connection::make($config['mysql']);
        });

        $this->container->singleton(QueryManagerInterface::class, function () {
            return new Statement($this->container->get(Connection::class));
        });
    }

}