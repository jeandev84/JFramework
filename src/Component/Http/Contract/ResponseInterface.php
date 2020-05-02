<?php
namespace Jan\Component\Http\Contract;


/**
 * Interface ResponseInterface
 * @package Jan\Component\Http\Contract
*/
interface ResponseInterface
{
    /**
     * send informations to server
    */
    public function send();
}