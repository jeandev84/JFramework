<?php
namespace App\Middlewares;


use Jan\Component\Http\Message\RequestInterface;
use Jan\Component\Http\Message\ResponseInterface;
use Jan\Component\Http\Middleware\MiddlewareInterface;



/**
 * Class Authenticated
 * @package App\Middlewares
*/
class Authenticated implements MiddlewareInterface
{

    /**
     * Authenticated constructor.
    */
    public function __construct()
    {
        if(session_status() == PHP_SESSION_NONE)
        {
            session_start();
        }

        if(isset($_SESSION['auth']))
        {
            header('Location: /dashboard');
            exit;
        }
    }


    /**
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @param callable $next
     * @return mixed
    */
    public function __invoke(RequestInterface $request, ResponseInterface $response, callable $next)
    {
         if(! isset($_SESSION['auth']))
         {
             header('Location: /');
             exit;
         }

         return $next($request, $response);
    }
}