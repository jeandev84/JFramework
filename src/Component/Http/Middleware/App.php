<?php
namespace Jan\Component\Http\Middleware;


use Jan\Component\Http\Middleware\Example\FirstMiddleware;
use Jan\Component\Http\Middleware\Example\SecondMiddleware;
use Jan\Component\Http\Request;
use Jan\Component\Http\Response;

/**
 * Class App
 * @package Jan\Component\Http\Middleware
 */
class App
{

    /** @var MiddlewareStack */
    protected $middlewareStack;


    /**
     * App constructor.
     * @param MiddlewareStack $middlewareStack
     */
    public function __construct(MiddlewareStack $middlewareStack)
    {
        $this->middlewareStack = $middlewareStack;
    }


    public function add(MiddlewareInterface $middleware)
    {
        $this->middlewareStack->add($middleware);
    }



    public function run()
    {
        $result = $this->middlewareStack->handle(new Request(), new Response());


        dump('run app', $result);
    }
}

$app = new App(new MiddlewareStack());

$app->add(new FirstMiddleware());
$app->add(new SecondMiddleware());

$app->run();