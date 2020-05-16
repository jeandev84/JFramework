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
    public function post(string $key = null)
    {
        return $this->getParameter($key, $_POST);
    }

    /**
     * @param string $key
     * @return mixed|null
     */
    public function get(string $key = null)
    {
        return $this->getParameter($key, $_GET);
    }


    /**
     * @param string $key
     * @return mixed|null
     */
    public function server(string $key = null)
    {
        return $this->getParameter($key, $_SERVER);
    }


    /**
     * @param string|null $key
     * @param array $data
     * @param null $default
     * @return array|mixed|null
    */
    protected function getParameter(string $key = null, array $data = [], $default = null)
    {
        if(is_null($key))
        {
            return $data;
        }
        return $data[$key] ?? $default;
    }
}