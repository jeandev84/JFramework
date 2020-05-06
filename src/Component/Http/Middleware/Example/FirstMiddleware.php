<?php
namespace Jan\Component\Http\Middleware\Example;


use Jan\Component\Http\Message\RequestInterface;
use Jan\Component\Http\Message\ResponseInterface;
use Jan\Component\Http\Middleware\MiddlewareInterface;


/**
 * Class FirstMiddleware
 * @package Jan\Component\Http\Middleware\Example
*/
class FirstMiddleware implements MiddlewareInterface
{
     public function __invoke(RequestInterface $request, ResponseInterface $response, callable $next): callable
     {
         dump('First middleware');
         return $next($request, $response);
     }
}