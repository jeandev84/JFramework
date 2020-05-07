<?php
namespace Jan\Component\Http\Middleware;


use Jan\Component\Http\Message\RequestInterface;
use Jan\Component\Http\Message\ResponseInterface;


/**
 * Class MiddlewareInterface
 * @package Jan\Component\Http\Middleware
*/
interface MiddlewareInterface
{
     /**
      * @param RequestInterface $request
      * @param ResponseInterface $response
      * @param callable $next
     */
     public function __invoke(RequestInterface $request, ResponseInterface $response, callable $next);
}