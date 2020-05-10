<?php
namespace Jan\Foundation;


use Jan\Component\Console\ConsoleInterface;

/**
 * Class CommandRegister
 * @package Jan\Foundation
*/
class CommandRegister
{

    /** @var ConsoleInterface  */
    protected $console;


    /**
     * CommandRegister constructor.
     * @param ConsoleInterface $console
    */
    public function __construct(ConsoleInterface $console)
    {
        $this->console = $console;
    }

    /**
     * @param array $commandStuff
    */
    public function register(array $commandStuff)
    {
        $this->console->loadCommands($commandStuff);
    }
}