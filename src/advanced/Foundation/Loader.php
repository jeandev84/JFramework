<?php
namespace Jan\Foundation;


use Jan\Component\DependencyInjection\Contracts\ContainerInterface;
use Jan\Component\FileSystem\FileSystem;

/**
 * Class Mix
 * @package Jan\Foundation
*/
class Loader
{
    /**
     * @var array
    */
    private $aliases = [
        'Route' => 'Jan\\Component\\Routing\\Route'
    ];


    /**
     * @var array
    */
    private $resources = [
       'routes/web.php',
       'routes/console.php',
       'routes/api.php'
    ];


    /** @var ContainerInterface  */
    private $container;


    /**
     * Loader constructor.
     * @param ContainerInterface $container
     * Or FileSystem
    */
    public function __construct(ContainerInterface $container)
    {
          $this->loadNamespaceAlias();
          $this->container = $container;
    }


    /**
     *  Load namespace aliases
    */
    protected function loadNamespaceAlias()
    {
        foreach ($this->aliases as $alias => $original)
        {
            class_alias($original, $alias);
        }

        return $this;
    }


    /**
     * Load resources
    */
    public function loadRouteResources()
    {
        foreach ($this->resources as $resource)
        {
            $this->load($resource);
        }
    }


    /**
     * Load app services providers
     * @param array $providers
    */
    public function loadServiceProviders(array $providers)
    {
        foreach ($providers as $provider)
        {
            $this->container->addServiceProvider($provider);
        }
    }

    /**
     * @param string $resource
     * @return bool|mixed
    */
    public function load(string $resource)
    {
        return $this->container[FileSystem::class]->load($resource);
    }
}