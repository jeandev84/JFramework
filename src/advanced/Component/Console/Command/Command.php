<?php
namespace Jan\Component\Console\Command;


/**
 * Class Command
 * @package Jan\Component\Console\Command
*/
abstract class Command implements CommandInterface
{

     /** @var string */
     protected $name = 'default:command';


     /**
      * @var string
     */
     protected $description;



     /** @var string */
     protected $help;



     /** @var array */
     protected $options = [];


     /**
      * @return void
     */
     protected function configure() { }


     /**
      * Command constructor.
     */
     public function __construct()
     {
         $this->configure();
     }


     /**
      * @return string
     */
     public function getArgument()
     {
         return $this->resolvedArgument($this->name);
     }

     /**
      * @return string
     */
     public function getDescription()
     {
         return  $this->description;
     }


     /**
      * @return string
     */
     public function getHelp()
     {
         return $this->help;
     }

     /**
      * @param $name
      * @return mixed|null
     */
     public function getOption($option)
     {
         return $this->options[$this->name][$option] ?? null;
     }

     /**
      * @param $name
      * @return bool
     */
     public function isOption($name)
     {
         return \in_array($name, $this->options[$this->name]);
     }

     /**
      * @param string $help
      * @return string
     */
     protected function addHelp(string $help)
     {
         $this->help = $help;

         return $this;
     }

     /**
      * @param $name
      * @return Command
     */
     protected function addArgument(string $name)
     {
         $this->name = $name;

         return $this;
     }


    /**
     * @param string $description
     * @return Command
     */
    protected function addDescription(string $description)
    {
        $this->description = $description;

        return $this;
    }


    /**
     * @param string $option
     * @param null $value
     * @return $this
    */
    protected function addOption(string $name, $value = null)
    {
        /*
        $this->options[$this->name][$name][] = [
            'option' => '--' . $name,
            'name' => $name,
            'value'    => $value
        ];
        */

        $this->options[$this->name][] = [
           '--'. $name,
           $name,
           $value
        ];

        return $this;
    }


    /**
     * @param $argument
     * @return string|string[]
   */
    private function resolvedArgument($argument)
    {
        return trim(str_replace(' ', '', $argument));
    }
}