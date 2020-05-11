<?php
namespace Jan\Routing;


/**
 * Class Route
 * @package Jan\Routing
 *
 * Route Facade
 */
class Route
{

    /**
     * @param $method
     * @param $arguments
    */
    public static function __callStatic($method, $arguments)
    {
        $router = new Router();
        call_user_func_array([$router, $method], $arguments);
    }
}