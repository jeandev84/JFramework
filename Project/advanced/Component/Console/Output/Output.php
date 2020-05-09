<?php
namespace Jan\Component\Console\Output;


/**
 * Class Output
 * @package Jan\Component\Console\Output
*/
class Output implements OutputInterface
{

    /**
     * @var array
    */
    protected $messages = [];


    /**
     * Output constructor.
    */
    public function __construct()
    {
    }


    /**
     * @param string $message
     * @return OutputInterface
    */
    public function write(string $message)
    {
        // TODO: Implement write() method.
    }


    /**
     * @return mixed
    */
    public function getMessage()
    {
        // TODO: Implement getMessage() method.
    }
}