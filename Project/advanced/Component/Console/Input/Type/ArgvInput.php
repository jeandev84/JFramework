<?php
namespace Jan\Component\Console\Input\Type;


use Jan\Component\Console\Input\Input;


/**
 * Class ArgvInput
 * @package Jan\Component\Console\Input\Type
*/
class ArgvInput extends Input
{

    /** @var array */
    protected $tokens;


    /** @var array  */
    protected $arguments = [];


    /** @var array  */
    protected $options = [];


    /**
     * Input constructor.
     * @param array $tokens [ Arguments CLI $argv or $_SERVER['argv']
     */
    public function __construct(array $tokens = [])
    {
        if(! $tokens)
        {
            $tokens = $_SERVER['argv'] ?? [];
        }

        array_shift($tokens);
        $this->tokens = $tokens;
    }


    /**
     * @return mixed
    */
    public function parse()
    {
        // TODO: Implement parse() method.
    }


    /**
     * @return array|mixed
    */
    public function getTokens()
    {
        return $this->tokens;
    }
}