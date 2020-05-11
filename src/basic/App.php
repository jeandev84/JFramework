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

    /**
     * App constructor.
     * @param $method
     * @param $arguments
    */
    public function __call($method, $arguments)
    {
        $router = new Router();
        call_user_func_array([$router, $method], $arguments);
    }


    /**
     *
    */
    public function run()
    {
        //
    }
}