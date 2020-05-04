<?php
namespace App\Console;


use Jan\Component\Console\Input\InputInterface;
use Jan\Component\Console\Output\OutputInterface;
use Jan\Foundation\Console\Kernel as ConsolKernel;


/**
 * Class Kernel
 * @package App\Console
 */
class Kernel extends ConsolKernel
{

       /** @var array  */
       protected $commands = [


       ];


       public function loadCommand()
       {

       }

       /**
       public function sheduleShell($inspire)
       {
           // Schedule::inspire('', ...' ..);
       }
       */

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return mixed
     */
    public function handle(InputInterface $input, OutputInterface $output)
    {
        // TODO: Implement handle() method.
    }

    /**
     * @param InputInterface $input
     * @param $status
     * @return mixed
     */
    public function terminate(InputInterface $input, $status)
    {
        // TODO: Implement terminate() method.
    }
}