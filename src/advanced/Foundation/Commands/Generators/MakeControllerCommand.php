<?php
namespace Jan\Foundation\Commands\Generators;

use Jan\Component\Console\Command\Command;
use Jan\Component\Console\Input\InputInterface;
use Jan\Component\Console\Output\OutputInterface;


/**
 * Class MakeControllerCommand
 * @package Jan\Foundation\Commands
*/
class MakeControllerCommand extends Command
{


     /** @var string  */
     protected $name = 'make:controller';


     /**
      * @param InputInterface $input
      * @param OutputInterface $output
      * @return mixed|void
     */
     public function execute(InputInterface $input, OutputInterface $output)
     {
            $output->write('Controller created successfully!');
     }
}