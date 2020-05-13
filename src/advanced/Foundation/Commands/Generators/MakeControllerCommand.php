<?php
namespace Jan\Foundation\Commands\Generators;

use Jan\Component\Console\Command\Command;
use Jan\Component\Console\Input\InputInterface;
use Jan\Component\Console\Output\OutputInterface;
use Jan\Component\FileSystem\FileSystem;


/**
 * Class MakeControllerCommand
 * @package Jan\Foundation\Commands
 *
 * TODO Refactoring
*/
class MakeControllerCommand extends Command
{


     /** @var string  */
     protected $name = 'make:controller';

     /** @var FileSystem */
     protected $fileSystem;

     /**
      * MakeControllerCommand constructor.
      * @param FileSystem $fileSystem
     */
     public function __construct(FileSystem $fileSystem)
     {
         parent::__construct();
         $this->fileSystem = $fileSystem;
     }


     /**
      * @param InputInterface $input
      * @param OutputInterface $output
      * @return mixed|void
     */
     public function execute(InputInterface $input, OutputInterface $output)
     {
         $content = file_get_contents(__DIR__.'/../stubs/controller.stub');
         $controllerName = $input->getToken(1);

         if($controllerName === '')
         {
             return;
         }

         $content = str_replace(
             ['ControllerNamespace', 'ControllerClass'],
             ['App\\Controllers', $controllerName],
             $content
         );

         $filename = 'app/Controllers/'. $controllerName .'.php';

         if(! $this->fileSystem->exists($filename))
         {
             $this->fileSystem->write($filename, $content);
             $output->write('Controller '. $filename .' created successfully!');
         }else {
             $output->write('Controller ' . $filename . ' already exist');
         }
     }
}