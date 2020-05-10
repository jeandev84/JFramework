<?php
namespace Jan\Component\Http;

use Jan\Component\Http\Message\RequestInterface;



/**
 * Class Request
 * @package Jan\Component\Http
 *
 * TODO Big request handle later
 *
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
        return $this->server('REQUEST_URI');
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
        return $this->server('REQUEST_METHOD');
    }


    /**
     * @return bool
     */
    public function isAjax()
    {
        return $this->server('HTTP_X_REQUESTED_WITH') === 'XMLHttpRequest';
    }

    /**
     * @return bool
     */
    public function isPost()
    {
        return $this->getMethod() === 'POST';
    }

    /**
     * @param string $key
     * @return mixed|null
     */
    public function post(string $key)
    {
        return $_POST[$key] ?? null;
    }

    /**
     * @param string $key
     * @return mixed|null
     */
    public function get(string $key)
    {
        return $_GET[$key] ?? null;
    }


    /**
     * @param string $key
     * @param null $default
     * @return mixed|null
     */
    public function server(string $key, $default = null)
    {
        return $_SERVER[$key] ?? $default;
    }
}