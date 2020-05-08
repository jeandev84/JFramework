<?php
namespace Jan\Foundation\Parse;


/**
 * Class CustomBody
 * @package Jan\Foundation\Parse
*/
abstract class CustomBody implements BodyInterface
{

    protected $body;


    public function __construct($body)
    {
        $this->body = $body;
    }

    /**
     * @return mixed
     */
    public function getTarget()
    {
        // TODO: Implement getTarget() method.
    }

}