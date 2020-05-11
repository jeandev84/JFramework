<?php
namespace Jan\Component\Console;

use Jan\Component\Console\Command\Command;
use Jan\Component\Console\Command\Support\HelpCommand;
use Jan\Component\Console\Command\Support\ListCommand;
use Jan\Component\Console\Input\InputInterface;
use Jan\Component\Console\Output\OutputInterface;


/**
 * Class Console
 * @package Jan\Component\Console
 *
 * Invoker
 *
 * TODO More advanced
*/
class Console implements ConsoleInterface
{

      /** @var array  */
      protected $commands = [];


      protected $defaultCommand;


      /**
       * Console constructor.
      */
      public function __construct()
      {
          if(php_sapi_name() != 'cli')
          {
              exit('Access denied!');
          }

          $this->defaultCommand = 'list';
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
             $this->commands[$command->getName()] = $command;

             return $this;
      }


      /**
        * @param array $commandStack
        * @return Console
      */
      public function loadCommands(array $commandStack)
      {
          foreach ($commandStack as $command)
          {
              $this->addCommand($command);
          }

          return $this;
      }


      /**
       * Get all stuff command
       * @return array
      */
      public function getCommands()
      {
          return $this->commands;
      }


      /**
       * @param InputInterface $input
       * @param OutputInterface $output
       * @return string
       * @throws \Exception
      */
      public function handle(InputInterface $input = null, OutputInterface $output = null)
      {
             $name = $this->getCommandName($input);

             if(\array_key_exists($name, $this->commands))
             {
                  $this->runCommand($name, $input, $output);
             }

             return $output->send() ."\n";
      }


      /**
        * @param InputInterface $input
        * @return mixed
      */
      protected function getCommandName(InputInterface $input)
      {
           return $input->getFirstArgument();
      }


      /**
       * @param $name
       * @param InputInterface $input
       * @param OutputInterface $output
       * @return bool|mixed|void
       * @throws \Exception
      */
      public function runCommand($name, InputInterface $input, OutputInterface $output)
      {
            $command = $this->commands[$name];

            if(! $this->isCommand($command))
            {
                 //TODO implement message
                 return false;
            }

            return $command->execute($input, $output);
      }


      /**
       * @param $command
       * @return bool
      */
      protected function isCommand($command)
      {
          return $command instanceof Command;
      }
}