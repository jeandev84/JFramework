<?php
namespace Jan\Component\DependencyInjection\ServiceProvider;


use Jan\Component\DependencyInjection\Contracts\ContainerInterface;

/**
 * Trait ServiceProviderTrait
 * @package Jan\Component\DependencyInjection\ServiceProvider
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