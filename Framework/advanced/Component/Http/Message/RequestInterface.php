<?php
namespace Jan\Component\Http\Message;


/**
 * Interface RequestInterface
 * @package Jan\Component\Http\Message
*/
interface RequestInterface
{

    /**
     * @return mixed
    */
    public function getBaseUrl();


    /**
     * Get URI
     * @return mixed
    */
    public function getUri();


    /**
     * @return mixed
    */
    public function getMethod();
}