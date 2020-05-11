<?php
namespace Jan\DI\ServiceProvider;


use Jan\DI\Contracts\ContainerInterface;

/**
 * Trait ServiceProviderTrait
 * @package Jan\DI\ServiceProvider
*/
trait ServiceProviderTrait
{

    /** @var ContainerInterface */
    public $container;


    /**
     * @param ContainerInterface $container
     */
    public function setContainer(ContainerInterface $container)
    {
        $this->container = $container;
    }


    /**
     * @return ContainerInterface
    */
    public function getContainer()
    {
        return $this->container;
    }
}