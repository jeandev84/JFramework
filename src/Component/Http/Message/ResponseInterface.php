<?php
namespace Jan\Component\Http\Message;


/**
 * Interface ResponseInterface
 * @package Jan\Component\Http\Message
*/
interface ResponseInterface
{
    /**
     * send informations to server
    */
    public function send();
}