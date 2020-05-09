<?php
namespace Jan\Component\Console;


use Jan\Component\Console\Command\Command;
use Jan\Component\Console\Input\InputInterface;
use Jan\Component\Console\Output\OutputInterface;



/**
 * Interface ConsoleInterface
 * @package Jan\Component\Console
 *
 * Invoker command interface
*/
interface ConsoleInterface
{

     /**
      * @param Command $command
      * @return mixed
     */
     public function addCommand(Command $command);


     /**
      * @param InputInterface $input
      * @param OutputInterface $output
      * @return mixed
     */
     public function handle(InputInterface $input, OutputInterface $output);
}