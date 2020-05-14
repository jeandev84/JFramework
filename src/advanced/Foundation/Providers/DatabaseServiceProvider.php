<?php
namespace Jan\Foundation\Providers;


use Jan\Component\Database\Connection;
use Jan\Component\Database\Contracts\QueryManagerInterface;
use Jan\Component\Database\Statement;
use Jan\Component\DI\Contracts\BootableServiceProvider;
use Jan\Component\DI\ServiceProvider\AbstractServiceProvider;
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
            $config = $this->container->get('config');
            $configParams = $config->get('database.'. getenv('DB_CONNECTION'));
            return Connection::make($configParams);
        });

        $this->container->bind('connection.status', function () {
            return Connection::getStatus() == true ? 'Connected ' : 'Disconnected';
        });

        $this->container->singleton(QueryManagerInterface::class, function () {
            return new Statement($this->container->get(Connection::class));
        });
    }

}