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
      * @return mixed
     */
     public function getCommands();


     /**
      * @param InputInterface $input
      * @param OutputInterface $output
      * @return mixed
     */
     public function handle(InputInterface $input = null, OutputInterface $output = null);
}