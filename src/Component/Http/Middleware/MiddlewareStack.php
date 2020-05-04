<?php
namespace Jan\Component\Http\Middleware;


/**
 * Class MiddlewareStack
 * @package Jan\Component\Http\Middleware
*/
class MiddlewareStack
{

       /** @var array  */
       protected $middlewares = [];


       /**
        * MiddlewareStack constructor.
        * @param array $middlewares
       */
      public function __construct(array $middlewares = [])
      {
          $this->middlewares = $middlewares;
      }

      /**
       * @param MiddlewareInterface $middleware
      */
      public function add(MiddlewareInterface $middleware)
      {
          $this->middlewares[] = $middleware;
      }


      /**
        * Run all middlewares
      */
      public function run()
      {
          foreach ($this->middlewares as $middleware)
          {
               $middleware();
          }
      }
}