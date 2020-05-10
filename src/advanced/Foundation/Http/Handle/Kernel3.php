<?php
namespace Jan\Foundation\Http\Handle;


use Jan\Component\Database\Contracts\QueryManagerInterface;
use Jan\Component\DependencyInjection\Contracts\ContainerInterface;
use Jan\Component\Dotenv\Env;
use Jan\Component\Http\Message\RequestInterface;
use Jan\Component\Http\Message\ResponseInterface;
use Jan\Component\Routing\RouteParam;
use Jan\Contracts\Http\Kernel as HttpKernelContract;
use Jan\Foundation\Loader;
use Jan\Foundation\RouteDispatcher;


/**
 * Class Kernel3
 * @package Jan\Foundation\Http
 */
abstract class Kernel3 implements HttpKernelContract
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
     */
    public function handle(RequestInterface $request): ResponseInterface
    {
        try {

            $dispatcher = $this->container->get(RouteDispatcher::class);
            $dispatcher->addMiddlewares(array_merge($this->middlewares, $this->routeMiddlewares));
            $response = $dispatcher->callAction();

        } catch (\Exception $e) {

            $debug = getenv('APP_DEBUG');

            # Tres important de comparer au string "true" de la sorte
            if($debug == "true")
            {
                $this->displayError($e);

            }else{

                $viewObject = $this->container->get('view');
                $viewPath = 'errors/'. $e->getCode() . '.php';
                $template = $viewObject->resourcePath($viewPath);
                $response = $this->container->get(ResponseInterface::class);

                if($viewObject->loadIf($template))
                {
                    $template = $viewObject->render($viewPath, compact('e'));
                    # templates/errors/404.php
                    # templates/errors/400.php
                    # templates/errors/500.php

                    $response->withStatus($e->getCode())
                        ->withBody($template);
                } else{

                    exit('View ' . $viewObject->resourcePath($template) . ' does not exist!');
                }
            }

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


    /**
     * @param \Exception $e
     */
    protected function displayError(\Exception $e)
    {
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
    }
}