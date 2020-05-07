<?php
namespace Jan\Foundation\Http;


use Jan\Component\Database\Contracts\QueryManagerInterface;
use Jan\Component\DependencyInjection\Contracts\ContainerInterface;
use Jan\Component\Dotenv\Env;
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
          $this->loadEnvironments();
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
            $dispatcher->addMiddlewares($this->routeMiddlewares);
            $dispatcher->setContainer($this->container);

            // return instance of ResponseInterface
            $response = $dispatcher->callAction();

        } catch (\Exception $e) {

            // TODO Implement Error Handler
            echo '<div class=""><h2>Fatal error</h2>';
            echo '<b>Message</b> : '. $e->getMessage().'<br>';
            echo '<b>Code</b> : '. $e->getCode().'<br>';
            echo '<b>Line</b> : '. $e->getLine().'<br>';
            echo '<b>File path</b> : '. $e->getFile().'<br>';
            echo '<b>Trace String</b> : '. $e->getTraceAsString().'<br>';
            // echo 'Trace : '. dump($e->getTrace());
            echo '</div>';
            exit('Something want wrong!');

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

        $query = $this->container->get(QueryManagerInterface::class);
        if($executed = $query->executedSql())
        {
            echo "From : ". __METHOD__.'<br>';
            dump($executed);
        }
    }


    /**
     * Load environment variables
    */
    protected function loadEnvironments()
    {
        try {

            $dotenv = (new Env($this->container->get('base.path')))
                      ->load();

        } catch (\Exception $e) {
            exit($e->getMessage());
        }
    }
}