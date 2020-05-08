<?php
namespace Jan\Component\Console\Example;

use Jan\Component\Console\Command\Command;
use Jan\Component\Console\Input\InputInterface;
use Jan\Component\Console\Output\OutputInterface;


/**
 * Class HelloCommand
 * @package Jan\Component\Console\Example
 */
class HelloCommand extends Command
{

    /**
     * @return string
    */
    public function getArgument()
    {
        return 'hello --table=users';
    }

    /**
     * @return string
    */
    public function getDescription()
    {
        return '';
    }


    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return mixed|void
    */
    public function execute(InputInterface $input, OutputInterface $output)
    {
         echo __METHOD__."\n";
         $output->write('Hello command executed successfully!')
                ->writeln('Bye!');
    }

}