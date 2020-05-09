<?php
namespace Jan\Foundation\Http;


use Jan\Component\Database\Contracts\QueryManagerInterface;
use Jan\Component\DependencyInjection\Contracts\ContainerInterface;
use Jan\Component\Dotenv\Env;
use Jan\Component\Http\Message\RequestInterface;
use Jan\Component\Http\Message\ResponseInterface;
use Jan\Component\Routing\RouteParam;
use Jan\Component\Templating\View;
use Jan\Contracts\Http\Kernel as HttpKernelContract;
use Jan\Foundation\Loader;
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
     * @throws \Exception
    */
    public function handle(RequestInterface $request): ResponseInterface
    {
        try {

            $dispatcher = $this->container->get(RouteDispatcher::class);
            $dispatcher->addMiddlewares($this->getMiddlewares());
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
                     $content = $viewObject->render($viewPath, compact('e'));
                     # templates/errors/404.php
                     # templates/errors/400.php
                     # templates/errors/500.php

                     $response->withStatus($e->getCode())
                              ->withBody($content);
                  } else{

                     // throw $e;
                     $this->displayError($e);
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
     * Get stack of middlewares
     *
     *
     * @return array
    */
    protected function getMiddlewares()
    {
        return array_merge(
            $this->middlewares,
            $this->routeMiddlewares
        );
    }


    /**
     * @param \Exception $e
    */
    protected function displayError(\Exception $e)
    {
         $this->container->get('view')->render('errors/dev.php', compact('e'));
    }
}