<?php
namespace Jan\Component\Console;


use Jan\Component\Console\Command\Command;
use Jan\Component\Console\Command\CommandInterface;
use Jan\Component\Console\Input\InputInterface;
use Jan\Component\Console\Output\OutputInterface;


/**
 * Class Console
 * @package Jan\Component\Console
 *
 * //TODO more advanced
*/
class Console
{

     /** @var array  */
     protected $commands = [];

     /** @var array files we'll be executed */
     protected $compiles = ['console.php'];


     /**
      * Console constructor.
     */
     public function __construct() {}


     /**
      * @param Command $command
     */
     public function addCommand(Command $command)
     {
         $this->commands[$command->getArgument()] = $command;
     }



     /**
      * Add stack commands
      *
      * @param array $commands
      * @throws \Exception
     */
     public function addCommands(array $commands)
     {
        foreach ($commands as $command)
        {
            $this->addCommand($command);
        }
     }


     /**
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
     */
     public function handle(InputInterface $input, OutputInterface $output)
     {
         dd($this->commands);

         // TODO FIX
         $argument =  $input->getArgument();

         if(is_null($argument))
         {
             $output->break('Empty argument!');
         }

         if(! $this->hasCommand($argument))
         {


             $output->break(sprintf(
                 "Argument [%s] is not available command!\n", $argument
             ));
         }

         $command = $this->getCommand($argument);

         if($this->isCompiled($argument, $command->getArgument()))
         {
             $command->execute($input, $output);
         }

         # Terminate
         return $output->getMessage() ."\n";

         /* return $output; */
     }


    /**
     * Determine command argument match input argument
     *
     * @param $arginput
     * @param string $argcmd
     * @return bool
     */
     public function isCompiled($arginput, string $argcmd)
     {
         // TODO Refactoring
         return preg_match('#^'. $arginput .'$#i', $argcmd) ? true : false;
     }

    /**
     * @param $name
     * @return bool
     */
    public function hasCommand($name)
    {
        return isset($this->commands[$name]);
    }


    /**
     * @param $name
     * @return Command
    */
    public function getCommand($name): Command
    {
        return $this->commands[$name];
    }


     public function help()
     {

     }

     /**
      * @param OutputInterface $output
     */
     public function blankHeader(OutputInterface $output)
     {
          //
     }

     /**
      * @param OutputInterface $output
     */
     public function blankFooter(OutputInterface $output)
     {
         //
     }
}