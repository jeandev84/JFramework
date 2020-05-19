<?php
namespace Jan\Foundation\Providers;


use Jan\Component\Database\Connection;
use Jan\Component\Database\Connectors\PDO\Query;
use Jan\Component\Database\Contracts\EntityManagerInterface;
use Jan\Component\Database\Contracts\EntityRepositoryInterface;
use Jan\Component\Database\Contracts\ManagerInterface;
use Jan\Component\Database\ORM\EntityManager;
use Jan\Component\Database\ORM\EntityRepository;
use Jan\Component\DI\Contracts\BootableServiceProvider;
use Jan\Component\DI\ServiceProvider\AbstractServiceProvider;



/**
 * Class DatabaseServiceProvider
 * @package Jan\Foundation\Providers
*/
class DatabaseServiceProvider extends AbstractServiceProvider implements BootableServiceProvider
{

    /**
     * @return mixed
     * @throws \Exception
    */
    public function boot()
    {
        $config = $this->container->get('config');
        $configParams = $config->get('database.'. getenv('DB_CONNECTION'));
        Connection::open($configParams);
    }


    /**
     * @return mixed
    */
    public function register()
    {
        $this->container->singleton(Connection::class, function () {
            return Connection::instance();
        });

        $this->container->singleton(ManagerInterface::class, function () {
            return new Query($this->container[Connection::class]);
        });


        $this->container->singleton(EntityRepositoryInterface::class, function () {
            $manager = $this->container->get(ManagerInterface::class);
            return new EntityRepository($manager);
        });


        $this->container->singleton(EntityManagerInterface::class, function () {
            $manager = $this->container->get(ManagerInterface::class);
            return new EntityManager($manager);
        });
    }

}