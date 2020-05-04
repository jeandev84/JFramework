<?php
namespace App\Http;


use Jan\Component\DependencyInjection\Contracts\ContainerInterface;
use Jan\Component\Routing\RouteParam;
use Jan\Component\Http\Message\RequestInterface;
use Jan\Component\Http\Message\ResponseInterface;
use Jan\Foundation\Routing\RouteDispatcher;


/**
 * Class Kernel
 * @package App\Http
*/
class Kernel
{

    /** @var ContainerInterface  */
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
    */
    public function handle(RequestInterface $request): ResponseInterface
    {
          // Run action stack middlewares


          // Routing
          $router = $this->container->get('router');
          $route = $router->match($request->getMethod(), $request->getUri());

          $dispatcher = new RouteDispatcher(new RouteParam($route));
          $dispatcher->setContainer($this->container);
          $response = $dispatcher->callAction();

          // Response
          /*
          $response = $this->container->get(ResponseInterface::class);
          $response->setContent($body);
          */
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
          */

          dump("Terminate ". __METHOD__);
    }
}