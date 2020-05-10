<?php
namespace Jan\Component\Console;

use Jan\Component\Console\Command\Command;
use Jan\Component\Console\Input\InputInterface;
use Jan\Component\Console\Output\OutputInterface;


/**
 * Class Console
 * @package Jan\Component\Console
 *
 * Invoker
*/
class Console implements ConsoleInterface
{

      /** @var array  */
      protected $commands = [];


      /**
       * Console constructor.
      */
      public function __construct()
      {
          if(php_sapi_name() != 'cli')
          {
              exit('Access denied!');
          }
      }


      /**
       * @param $name
       * @return bool
      */
      public function hasCommand($name)
      {
          return \array_key_exists($name, $this->commands);
      }

      /**
       * @param Command $command
       * @return Console
      */
      public function addCommand(Command $command)
      {
             $this->commands[] = $command;

             return $this;
      }


      /**
        * @param array $commandStack
        * @return Console
      */
      public function addCommands(array $commandStack)
      {
          foreach ($commandStack as $command)
          {
              $this->addCommand($command);
          }

          return $this;
      }


      /**
       * @param InputInterface $input
       * @param OutputInterface $output
       * @return string
      */
      public function handle(InputInterface $input, OutputInterface $output)
      {
             dump($input->getTokens());
             return "End execution!\n";
      }
}