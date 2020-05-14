<?php
namespace App\Middlewares;


use Jan\Component\Http\Message\RequestInterface;
use Jan\Component\Http\Message\ResponseInterface;
use Jan\Component\Http\Middleware\MiddlewareInterface;


/**
 * Class Ajax
 * @package App\Middlewares
*/
class Ajax implements MiddlewareInterface
{

    /**
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @param callable $next
     * @return mixed
    */
    public function __invoke(RequestInterface $request, ResponseInterface $response, callable $next)
    {
        if(! $request->isAjax())
        {
             $response->withHeaders(['Location' => '/'])
                      ->withStatus(500)
                      ->withBody('Bad request');
        }

        return $next($request, $response);
    }
}