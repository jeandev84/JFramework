<?php
namespace Jan\Component\Console\Input;


/**
 * Class InputOption
 * @package Jan\Component\Console\Input
*/
class InputOption
{

    /** @var array  */
    protected $options = [];


    /**
     * InputOption constructor.
     * @param array $options
    */
    public function __construct(array $options)
    {
        $this->options = $options;
    }
}