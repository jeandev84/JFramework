<?php
namespace Jan\Component\Console\Output;


/**
 * Class ConsoleOutput
 * @package Jan\Component\Console\Output
 *
 * /TODO more advanced
*/
class ConsoleOutput implements OutputInterface
{

    /** @var array */
    private $message = [];


    /**
     * @param string $message
     * @return string|void
    */
    public function write(string $message)
    {
        $this->message[] = $message;

        return $this;
    }


    /**
     * @param string $message
     * @return OutputInterface
    */
    public function writeln(string $message)
    {
        $this->write(sprintf("%s\n", $message));

        return $this;
    }

    /**
     * @return string|void
    */
    public function getMessage()
    {
         return implode("\n", $this->message);
    }

    /**
     * @param string $message
    */
    public function break($message)
    {
        exit($message."\n");
    }


    /**
     * @param $message
     * @return \Exception
    */
    public function abortIf($message)
    {
        return new \Exception($message);
    }


    /**
     * @return string|void
    */
    public function __toString()
    {
        return $this->getMessage();
    }
}