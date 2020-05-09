<?php
namespace Jan\Contracts\Console;


use Jan\Component\Console\Input\InputInterface;
use Jan\Component\Console\Output\OutputInterfaceExample;

/**
 * Interface Kernel
 * @package Jan\Contracts\Console
*/
interface Kernel
{
      /**
       * @param InputInterface $input
       * @param OutputInterfaceExample $output
       * @return mixed
      */
      public function handle(InputInterface $input, OutputInterfaceExample $output);


      /**
       * @param InputInterface $input
       * @param $status
       * @return mixed
      */
      public function terminate(InputInterface $input, $status);
}