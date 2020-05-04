<?php
namespace Jan\Component\Http;

use Jan\Component\Http\Message\RequestInterface;



/**
 * Class Request
 * @package Jan\Component\Http
*/
class Request implements RequestInterface
{


    /**
     * Request constructor.
     * TODO add constructor params
    */
    public function __construct()
    {
    }


    /**
     * @return static
    */
    public static function createFromGlobals()
    {
        $request = new static();

        // Do something here

        return $request;
    }


    public static function createRequest()
    {
         //
    }


    protected static function factory()
    {
         //
    }


    /**
     * @return mixed
    */
    public function getUri()
    {
        return $_SERVER['REQUEST_URI'];
    }

    /**
     * @return mixed
    */
    public function getBaseUrl()
    {
        //
    }

    /**
     * @return mixed
     */
    public function getMethod()
    {
       return $_SERVER['REQUEST_METHOD'];
    }
}