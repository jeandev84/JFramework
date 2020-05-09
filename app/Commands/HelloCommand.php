<?php
namespace App\Commands;


use Jan\Component\Console\Command\Command;
use Jan\Component\Console\Input\InputInterface;
use Jan\Component\Console\Output\OutputInterfaceExample;


/**
 * Class HelloCommand
 * @package App\Commands
*/
class HelloCommand extends Command
{

    /** @var string  */
    protected $name = 'demo:command';


    /**
     * @param InputInterface $input
     * @param OutputInterfaceExample $output
     * @return mixed|void
    */
    public function execute(InputInterface $input, OutputInterfaceExample $output)
    {
        return 'Hello::executed!';
    }
}