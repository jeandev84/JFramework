<?php
//namespace Jan\Facades\Routing;
//
//
//use Jan\Component\Routing\RouteCollection;
//use Jan\Component\Routing\Router;
//
//
///**
// * Class Route
// * @package Jan\Facades\Routing
//*/
//class Route
//{
//
//     /**
//      * @param $method
//      * @param $arguments
//      * @return Router
//     */
//     public static function __callStatic($method, $arguments)
//     {
//         $router = new Router();
//         call_user_func_array([$router, $method], $arguments);
//         return $router;
//     }
//}