<?php
namespace Jan\Contracts\Http\Message;


/**
 * Interface RequestInterface
 * @package Jan\Contracts\Http\Message
*/
interface RequestInterface
{
    /**
     * Get URI
     * @return mixed
    */
    public function getUri();
}