<?php
namespace Jan\Foundation\Commands\Generators;

use Jan\Component\Console\Command\Command;
use Jan\Component\Console\Input\InputInterface;
use Jan\Component\Console\Output\OutputInterface;
use Jan\Component\FileSystem\FileSystem;


/**
 * Class MakeEntityCommand
 * @package Jan\Foundation\Commands
 *
 * TODO Refactoring
*/
class MakeEntityCommand extends Command
{


     /** @var string  */
     protected $name = 'make:entity';


     /** @var FileSystem */
     protected $fileSystem;


     /**
      * MakeEntityCommand constructor.
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
         $content = file_get_contents(__DIR__.'/../stubs/entity.stub');
         $modelName = $input->getToken(1);

         if($modelName === '')
         {
             return;
         }

         $content = str_replace(
             ['EntityNamespace', 'EntityClass'],
             ['App\\Entity', $modelName],
             $content
         );

         $filename = 'app/Entity/'. $modelName .'.php';

         if(! $this->fileSystem->exists($filename))
         {
             $this->fileSystem->write($filename, $content);
             $output->write('Entity '. $filename .' created successfully!');
         }else {
             $output->write('Entity ' . $filename . ' already exist');
         }
     }
}