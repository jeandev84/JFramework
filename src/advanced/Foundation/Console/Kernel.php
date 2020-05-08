<?php
namespace Jan\Foundation\Console;


use Jan\Component\Console\Input\InputInterface;
use Jan\Component\Console\Output\OutputInterface;
use Jan\Component\DependencyInjection\Contracts\ContainerInterface;


/**
 * Class Kernel
 * @package Jan\Foundation\Console
*/
abstract class Kernel implements \Jan\Contracts\Console\Kernel
{

    /**
     * @var ContainerInterface
    */
    protected $container;


    /**
     * Kernel constructor.
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }
}