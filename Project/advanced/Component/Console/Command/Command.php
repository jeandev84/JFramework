<?php
namespace Jan\Component\Console\Command;


use Jan\Component\Console\Input\InputArgument;
use Jan\Component\Console\Input\InputBag;
use Jan\Component\Console\Input\InputInterface;
use Jan\Component\Console\Input\InputOption;
use Jan\Component\Console\Output\OutputInterface;

/**
 * Class Command
 * @package Jan\Component\Console\Command
*/
abstract class Command implements CommandInterface
{

       /** @var string */
       protected $name;


       /** @var string */
       protected $description = '';


       /** @var string  */
       protected $help = '';



       /** @var InputBag */
       private $inputBag;


       /**
        * Configuration command
       */
       protected function configure() {}



       /**
        * Command constructor.
       */
       public function __construct()
       {
            $this->inputBag = new InputBag();
            $this->configure();
       }


       /**
        * @param string $name
        * @return Command
       */
       public function setName(string $name)
       {
           $this->makeSureisValidName($name);
           $this->name = $name;

           return $this;
       }


      /**
        * @return string
      */
      public function getName()
      {
           return trim($this->name);
      }


    /**
     * @param string $description
     * @return Command
     */
    public function setDescription(string $description)
    {
        $this->description = $description;

        return $this;
    }


    /**
     * @return string
    */
    public function getDescription()
    {
        return $this->description;
    }


    /**
     * @param string $help
     * @return $this
    */
    public function setHelp(string $help)
    {
        $this->help = $help;

        return $this;
    }


    /**
     * @return string
    */
    public function getHelp()
    {
        return $this->help;
    }


    /**
     * @param string $name
     * @param string $description
     * @param null $default
     * @return Command
    */
    public function addArgument(string $name, string $description = '', $default = null)
    {
        $this->inputBag->addArgument(
            new InputArgument($name, $description, $default)
        );

        return $this;
    }


    /**
     * @param string $name
     * @param null $shortcut
     * @param string $description
     * @param null $default
     * @return Command
    */
    public function addOption(string $name, $shortcut = null, string $description = '', $default = null)
    {
           $this->inputBag->addOption(
               new InputOption($name, $shortcut, $description, $default)
           );

           return $this;
      }


      /**
       * @param $name
      */
      protected function makeSureisValidName($name)
      {
            //
      }


      /**
       * @param InputInterface|null $input
       * @param OutputInterface|null $output
       * @return mixed|void
       * @throws \Exception
      */
      public function execute(InputInterface $input, OutputInterface $output)
      {
           throw new \Exception('Command must be executed!');
      }

}