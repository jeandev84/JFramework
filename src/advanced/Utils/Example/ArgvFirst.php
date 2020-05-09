<?php
namespace Jan\Utils\Example;


/**
 * Class ArgvFirst
 * @package Jan\Utils\Example
 */
class ArgvFirst
{

    /** @var array */
    protected $arguments;


    /** @var array  */
    protected $options = [];


    /** @var array */
    protected $parses;


    /**
     * Argv constructor.
     * @param array $parses [ $_SERVER['argv'] or $argv ]
     */
    public function __construct(array $parses = [])
    {
        list($script, $name) = $parses;
        $this->arguments = compact('script', 'name');
        $this->parses = $parses;

        /*
        $this->options = array_filter($parses, function ($key) {
            return $key > 1;
        }, ARRAY_FILTER_USE_KEY);
        */

        $this->options = array_filter($parses, function ($key, $value) {
            return $key > 1 && stripos($value, '--') !== false;
        }, ARRAY_FILTER_USE_BOTH);
    }


    /**
     * @return array
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * Get argument
     *
     * @param $key
     * @return mixed
     */
    public function getArgument($key)
    {
        return trim($this->arguments[$key]) ?? null;
    }

    /**
     * @param $key
     * @return bool
     */
    public function hasArgument($key)
    {
        return \array_key_exists($key, $this->arguments);
    }

    function printMenu() {

        echo "************ Reservation System ******************\n";
        echo "1 - Choose Source\n";
        echo "2 - Choose Destination\n";
        echo "3 - Personal Details\n";
        echo "4 - Make Reservation\n";
        echo "5 - Quit\n";
        echo "************ Reservation System ******************\n";
        echo "Enter your choice from 1 to 5 ::";
    }
}