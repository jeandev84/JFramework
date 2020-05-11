<?php
namespace Jan\Foundation\Command;


use Jan\Component\Console\Command\Command;
use Jan\Component\Console\ConsoleInterface;
use Jan\Component\DependencyInjection\Contracts\ContainerInterface;


/**
 * Class CommandResolver
 * @package Jan\Foundation\Command
*/
class CommandResolver
{

     /** @var ContainerInterface */
     protected $container;


     /**
      * CommandStack constructor.
      * @param ContainerInterface $container
     */
     public function __construct(ContainerInterface $container)
     {
           $this->container = $container;
     }


     /**
      * @param array $commands
      * @return array
     */
     public function resolve(array $commands)
     {
         $resolved = [];

         foreach ($commands as $command)
         {
             if(! \in_array($command, $resolved))
             {
                 if($this->isCommand($command))
                 {
                     $resolved[] = $command;
                 }else{
                     $resolved[] = $this->container->get($command);
                 }
             }
         }

         return $resolved;
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