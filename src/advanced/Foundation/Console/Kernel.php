<?php
namespace Jan\Foundation\Console;


use Jan\Component\Console\Command\Command;
use Jan\Component\Console\ConsoleInterface;
use Jan\Component\Console\Input\InputInterface;
use Jan\Component\Console\Output\OutputInterface;
use Jan\Component\DependencyInjection\Contracts\ContainerInterface;
use Jan\Contracts\Console\Kernel as ConsoleKernelContract;
use Jan\Foundation\Loader;



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
     * Default commands
     *
     * @var array
    */
    protected $commands = [
        \Jan\Foundation\Commands\Generators\MakeCommand::class,
        \Jan\Foundation\Commands\Generators\MakeControllerCommand::class
    ];



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
     * @param OutputInterface $output
     * @return mixed
     * @throws \Exception
    */
    public function handle(InputInterface $input, OutputInterface $output)
    {
        $console = $this->container->get(ConsoleInterface::class);
        $console->loadCommands(
            $this->getResolvedCommandStuff()
        );
        return $console->handle($input, $output);
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




    /**
     * @return array
    */
    protected function getResolvedCommandStuff()
    {
        $resolved = [];

        foreach ($this->getCommands() as $command)
        {
            if($this->isCommand($command))
            {
                $resolved[] = $command;
            }else{
                $resolved[] = $this->container->get($command);
            }
        }

        return $resolved;
    }


    /**
     * @return array
    */
    private function getCommands()
    {
        $commands = $this->container
                         ->get(Loader::class)
                         ->loadCommands(); // config/command.php

        return array_merge($commands, $this->commands);
    }

    /**
     * @param $command
     * @return bool
    */
    private function isCommand($command)
    {
        return $command instanceof Command;
    }
}