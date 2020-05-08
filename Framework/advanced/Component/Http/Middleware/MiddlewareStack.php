<?php
namespace Jan\Component\Http\Middleware;


use Jan\Component\DependencyInjection\Contracts\ContainerInterface;
use Jan\Component\Http\Message\RequestInterface;
use Jan\Component\Http\Message\ResponseInterface;
use function Sodium\add;

/**
 * Class MiddlewareStack
 * @package Jan\Component\Http\Middleware
*/
class MiddlewareStack
{

       /** @var  mixed */
       protected $start;


       /**
        * MiddlewareStack constructor.
        * @param array $middlewares
       */
      public function __construct()
      {
          $this->start = function (RequestInterface $request, ResponseInterface $response) {

              return $response;
          };

      }


      /**
       * @param MiddlewareInterface $middleware
       * @return MiddlewareStack
      */
      public function add(MiddlewareInterface $middleware)
      {
          $next = $this->start;

          $this->start = function (RequestInterface $request, ResponseInterface $response) use ($middleware, $next) {

                return $middleware->__invoke($request, $response, $next);
          };

          return $this;
      }


      /**
        * Run all middlewares
      */
      public function handle(RequestInterface $request, ResponseInterface $response)
      {
          /* return call_user_func($this->start); */
          return call_user_func_array($this->start, [$request, $response]);
      }
}

/*
$middlewareStack = new MiddlewareStack();
$middlewareStack->add(new AuthenticateMiddleware());
$middlewareStack->add(new NoUserMiddleware());

$middlewareStack->handle();
*/