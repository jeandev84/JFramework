<?php
namespace Jan\Component\Console\Command;


/**
 * Class Command
 * @package Jan\Component\Console\Command
*/
abstract class Command implements CommandInterface
{

       /** @var string */
       protected $name;


       /**
        * Command constructor.
       */
       public function __construct()
       {
            $this->configure();
       }

       /**
        * Configuration command
       */
       protected function configure()
       {
            //
       }


       public function setName(string $name)
       {
           $this->name = $name;
       }
}