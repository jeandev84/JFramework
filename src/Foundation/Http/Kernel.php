<?php
namespace Jan\Foundation\Http;


use Jan\Component\DependencyInjection\Contracts\ContainerInterface;
use Jan\Component\Http\Message\RequestInterface;
use Jan\Component\Http\Message\ResponseInterface;
use Jan\Component\Routing\RouteParam;
use Jan\Contracts\Http\Kernel as HttpKernelContract;
use Jan\Foundation\RouteDispatcher;


/**
 * Class Kernel
 * @package Jan\Foundation\Http
 */
abstract class Kernel implements HttpKernelContract
{

    /**
     * @var array
    */
    protected $middlewares = [];


    /**
     * @var array
    */
    protected $routeMiddlewares = [];


    /** @var ContainerInterface */
    protected $container;


    /**
     * Kernel constructor.
     * @param ContainerInterface $container
    */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @param RequestInterface $request
     * @return ResponseInterface
     * @throws \ReflectionException
    */
    public function handle(RequestInterface $request): ResponseInterface
    {
        try {

            // Run action stack middlewares


            // Routing
            $router = $this->container->get('router');
            $route = $router->match($request->getMethod(), $request->getUri());
            $dispatcher = new RouteDispatcher(new RouteParam($route));
            $dispatcher->setContainer($this->container);

            // return instance of ResponseInterface
            $response = $dispatcher->callAction();

        } catch (\Exception $e) {

            die($e->getMessage());

            // Get new instance of error Handler and new ErrorHandler($e)
        }

        return $response;
    }


    /**
     * @param RequestInterface $request
     * @param ResponseInterface $response
     */
    public function terminate(RequestInterface $request, ResponseInterface $response)
    {
        /*
        Example
        if(! $request->getUri())
        {
            die($response->getMessage());
        }
        dump("Terminate en affichant des messages : Debug etc...". __METHOD__);
        */
        //echo '<div class="container">'. dump(__METHOD__) . '</div>';
    }
}