<?php
namespace Jan\Foundation\Commands\Generators;

use Jan\Component\Console\Command\Command;
use Jan\Component\Console\Input\InputInterface;
use Jan\Component\Console\Output\OutputInterface;
use Jan\Component\FileSystem\FileSystem;


/**
 * Class MakeModelCommand
 * @package Jan\Foundation\Commands
*/
class MakeModelCommand extends Command
{


     /** @var string  */
     protected $name = 'make:model';


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
         $content = file_get_contents(__DIR__.'/../stubs/model.stub');
         $modelName = $input->getToken(1);

         $content = str_replace(
             ['ModelNamespace', 'ModelClass'],
             ['App\\Entity', $modelName],
             $content
         );

         $filename = 'app/Models/'. $modelName .'.php';

         if(! $this->fileSystem->exists($filename))
         {
             $this->fileSystem->write($filename, $content);
             $output->write('Model '. $filename .' created successfully!');
         }else {
             $output->write('Model ' . $filename . ' already exist');
         }
     }
}