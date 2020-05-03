<?php
namespace Jan\Contracts\Http\Message;


/**
 * Interface ResponseInterface
 * @package Jan\Contracts\Http\Message
*/
interface ResponseInterface
{
    /**
     * send informations to server
    */
    public function send();
}