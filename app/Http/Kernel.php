<?php
namespace App\Http;


use Jan\Foundation\Http\Kernel as HttpKernel;


/**
 * Class Kernel
 * @package App\Http
*/
class Kernel extends HttpKernel
{

    /**
     * @var array
    */
    protected $middlewares = [];


    /**
     * @var array
    */
    protected $routeMiddlewares = [];

}