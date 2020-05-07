<?php
namespace App\Middlewares;


use Jan\Component\Http\Message\RequestInterface;
use Jan\Component\Http\Message\ResponseInterface;
use Jan\Component\Http\Middleware\MiddlewareInterface;



/**
 * Class DemoMiddleware
 * @package App\Middlewares
*/
class DemoMiddleware implements MiddlewareInterface
{

    /**
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @param callable $next
     */
    public function __invoke(RequestInterface $request, ResponseInterface $response, callable $next)
    {
         // dump('DemoMiddleware');

         if($request->getMethod() !== 'GET')
         {
             dump('Method is not GET');
         }

         return $next($request, $response);
    }
}