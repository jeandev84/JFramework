<?php
namespace Jan\Component\Console\Input\Type;


use Jan\Component\Console\Input\Input;
use Jan\Component\Console\Input\InputBag;


/**
 * Class ArgvInput
 * @package Jan\Component\Console\Input\Type
*/
class ArgvInput extends Input
{


    /** @var array */
    protected $tokens;


    /**
     * @var array
    */
    protected $shortcuts = [];


    /**
     * Input constructor.
     * @param array $tokens [ Arguments CLI $argv or $_SERVER['argv']
     * @param InputBag $inputBag
     */
    public function __construct(array $tokens = null, InputBag $inputBag = null)
    {
        if(is_null($tokens))
        {
            $tokens = $_SERVER['argv'] ?? [];
        }

        array_shift($tokens);
        $this->tokens = $tokens;

        parent::__construct($inputBag);
    }


    /**
     * Get tokens
     * (tokens) in this case are the parses arguments from cli or somewhere
     *
     * @return array|mixed
    */
    public function getTokens()
    {
        return $this->tokens;
    }


    /**
     * @return mixed
    */
    public function process()
    {
         $token = array_shift($this->tokens);

         $this->parseArgument($token);
    }


    /**
     * @param $token
    */
    protected function parseArgument($token)
    {
         $this->arguments['name'] = $token;
    }

    /**
     * @param $token
    */
    protected function parseShortOption($token)
    {
          //
    }


    /**
     * @param $token
    */
    protected function parseLongOption($token)
    {
          //
    }


    /**
     * @param string $token
     * @return string
    */
    protected function escapeToken(string $token)
    {
        return trim($token);
    }
}