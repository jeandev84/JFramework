<?php
namespace Jan\Component\Console\Example;


use Jan\Component\Console\Command\Command;
use Jan\Component\Console\Input\InputInterface;
use Jan\Component\Console\Output\OutputInterfaceExample;

/**
 * Class SendEmailCommand
 * @package Jan\Component\Console\Example
*/
class SendEmailCommand extends Command
{

    /**
     * @return string
    */
    public function getArgument()
    {
        return 'send:mail';
    }


    /**
     * @param InputInterface $input
     * @param OutputInterfaceExample $output
     * @return mixed|void
    */
    public function execute(InputInterface $input, OutputInterfaceExample $output)
    {
          $output->write('Message send successfully!');
    }

    /**
     * @return string|void
    */
    public function getDescription()
    {
        return 'Send mail description';
    }
}