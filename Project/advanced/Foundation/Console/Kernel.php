<?php
namespace Jan\Foundation\Console;


use Jan\Component\Console\Input\InputInterface;
use Jan\Component\Console\Output\OutputInterfaceExample;
use Jan\Component\DependencyInjection\Contracts\ContainerInterface;
use Jan\Contracts\Console\Kernel as ConsoleKernelContract;


/**
 * Class Kernel
 * @package Jan\Foundation\Console
*/
class Kernel implements ConsoleKernelContract
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

    /**
     * @param InputInterface $input
     * @param OutputInterfaceExample $output
     * @return mixed
    */
    public function handle(InputInterface $input, OutputInterfaceExample $output)
    {
        // TODO: Implement handle() method.
    }

    /**
     * @param InputInterface $input
     * @param $status
     * @return mixed
     */
    public function terminate(InputInterface $input, $status)
    {
        // TODO: Implement terminate() method.
    }
}