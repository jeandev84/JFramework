<?php
namespace App\Commands;


use Jan\Component\Console\Command\Command;
use Jan\Component\Console\Input\InputInterface;
use Jan\Component\Console\Output\OutputInterface;
use Jan\Component\FileSystem\FileSystem;


/**
 * Class DemoCommand
 * @package App\Commands
 */
class DemoCommand extends Command
{


    /** @var string  */
    protected $name = 'demo:command';


    /** @var FileSystem */
    protected $fileSystem;


    /**
     * DemoCommand constructor.
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
     * @throws \Exception
    */
    public function execute(InputInterface $input, OutputInterface $output)
    {
         $file = 'generators/demo.php';
         if($this->fileSystem->make($file))
         {
             $output->writeln('Generated new file : '. $this->fileSystem->resource($file));
             $output->write('File demo created successfully!');
         }
    }
}