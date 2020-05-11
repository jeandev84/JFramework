<?php
namespace Jan\Foundation\Commands\Generators;


use Jan\Component\Console\Command\Command;
use Jan\Component\Console\Input\InputInterface;
use Jan\Component\Console\Output\OutputInterface;



/**
 * Class MakeCommand
 * @package Jan\Foundation\Commands\Generators
 */
class MakeCommand extends Command
{


    /** @var string  */
    protected $name = 'make:command';


    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return mixed|void
     */
    public function execute(InputInterface $input, OutputInterface $output)
    {

        $output->write('Command generated successfully!');
    }
}