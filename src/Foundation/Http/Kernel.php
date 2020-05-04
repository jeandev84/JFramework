<?php
namespace Jan\Foundation\Http;


use Jan\Component\DependencyInjection\Contracts\ContainerInterface;
use Jan\Component\Http\Message\RequestInterface;
use Jan\Component\Http\Message\ResponseInterface;
use Jan\Component\Http\Request;
use Jan\Component\Http\Response;


/**
 * Class Kernel
 * @package Jan\Foundation\Http
 */
class Kernel implements \Jan\Contracts\Http\Kernel
{

    /**
     * @var array
     */
    protected $middlewares = [];


    /**
     * @var array
    */
    // protected $routeMiddlewares = [];


    /** @var ContainerInterface */
    protected $container;


    /**
     * Kernel constructor.
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
//          $this->container->singleton(ResponseInterface::class, function () {
//              return new Response();
//          });

        // dump($this->container->get(FileSystem::class));

        /* $this->runServiceProviders([]); */
        /* $this->container->addServiceProvider(new AppServiceProvider()); */
    }


    /**
     * @param RequestInterface $request
     * @return ResponseInterface
     */
    public function handle(RequestInterface $request): ResponseInterface
    {

        $response = $this->container->get(ResponseInterface::class);


        return $response;
    }


    /**
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @return mixed
     */
    public function terminate(RequestInterface $request, ResponseInterface $response)
    {
        // dump($this->container);
        dump('Terminate avec gestions des erreurs : '. __METHOD__);
    }
}