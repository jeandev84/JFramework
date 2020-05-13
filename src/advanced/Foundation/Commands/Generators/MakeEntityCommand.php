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
         //TODO Refactoring

         $entityName = $input->getToken(1);

         if($entityName === '')
         {
             return;
         }

         # Generate Entity
         $entity = file_get_contents(__DIR__.'/../stubs/entity.stub');

         $entity = str_replace(
             ['EntityNamespace', 'EntityClass'],
             ['App\\Entity', $entityName],
             $entity
         );

         $entityFilename = 'app/Entity/'. $entityName .'.php';

         if(! $this->fileSystem->exists($entityFilename))
         {
             $this->fileSystem->write($entityFilename, $entity);
             $output->write('Entity '. $entityFilename.' created successfully!');
         }else {
             $output->write('Entity ' . $entityFilename . ' already exist');
         }

         # Generate Repository
         $repository = file_get_contents(__DIR__.'/../stubs/repository.stub');
         $repositoryName = $entityName.'Repository';

         $repository = str_replace(
             ['EntityRepositoryNamespace', 'EntityRepositoryClass', 'EntityClass'],
             ['App\\Repository', $repositoryName, $entityName],
             $repository
         );

         $repositoryFilename = 'app/Repository/'. $repositoryName .'.php';

         if(! $this->fileSystem->exists($repositoryFilename))
         {
             $this->fileSystem->write($repositoryFilename, $repository);
             $output->writeln('Repository '. $repositoryFilename.' created successfully!');
         }else {
             $output->write('Repository' . $repositoryFilename . ' already exist');
         }
     }
}