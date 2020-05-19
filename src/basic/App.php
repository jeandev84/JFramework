<?php
namespace Jan;


use Jan\DI\Container;
use Jan\Routing\Router;


/**
 * Class App
 * @package Jan
 *
 * Facade
*/
class App extends Container
{

    /** @var array  */
    private $middlewares = [];


    /**
     * App constructor.
     * @param $method
     * @param $arguments
    */
    public function __call($method, $arguments)
    {
        $router = new Router();
        /* $request, $response */
        // parse params (Request, Response, arguments)
        call_user_func_array([$router, $method], $arguments);
    }


    /**
     * Run application
    */
    public function run()
    {
        //
    }
}