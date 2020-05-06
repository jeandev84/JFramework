<?php
namespace Jan\Component\Http\Middleware\Example;


use Jan\Component\Http\Message\RequestInterface;
use Jan\Component\Http\Message\ResponseInterface;
use Jan\Component\Http\Middleware\MiddlewareInterface;

/**
 * Class SecondMiddleware
 * @package Jan\Component\Http\Middleware\Example
*/
class SecondMiddleware implements MiddlewareInterface
{

    /**
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @param callable $next
     * @return callable
     */
     public function __invoke(RequestInterface $request, ResponseInterface $response, callable $next): callable
     {
         $response->withStatus(404);
         dump('Second middleware');
         return $next($request, $response);
     }
}