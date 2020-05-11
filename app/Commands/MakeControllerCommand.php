<?php
namespace App\Commands;


use Jan\Component\Console\Command\Command;
use Jan\Component\Console\Input\InputInterface;
use Jan\Component\Console\Output\OutputInterface;


/**
 * Class MakeControllerCommand
 * @package App\Commands
*/
class MakeControllerCommand extends Command
{

      /** @var string  */
      protected $name = 'make:controller';


      /**
       * @param InputInterface $input
       * @param OutputInterface $output
       * @return mixed|void
       * @throws \Exception
      */
      public function execute(InputInterface $input, OutputInterface $output)
      {

      }
}