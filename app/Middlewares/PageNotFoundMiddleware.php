<?php
namespace App\Middlewares;


use Jan\Component\Http\Message\RequestInterface;
use Jan\Component\Http\Message\ResponseInterface;
use Jan\Component\Http\Middleware\MiddlewareInterface;


/**
 * Class PageNotFoundMiddleware
 * @package App\Middlewares
*/
class PageNotFoundMiddleware implements MiddlewareInterface
{

    /**
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @param callable $next
     */
    public function __invoke(RequestInterface $request, ResponseInterface $response, callable $next)
    {
        // dump('NovalidKeyMiddleware');

        if($response->getStatus() == 404)
        {
             dump('Page not found');
        }

        return $next($request, $response);
    }
}