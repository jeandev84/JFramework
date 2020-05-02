<?php


/*
|----------------------------------------------------------------------
|   Autoloader classes and dependencies of application
|----------------------------------------------------------------------
*/


require_once realpath(__DIR__ .'/../vendor/autoload.php');



/*
|-------------------------------------------------------
|    Require bootstrap of Application
|-------------------------------------------------------
*/

$app = require_once realpath(__DIR__.'/../bootstrap/app.php');



/*
|-------------------------------------------------------
|    Check instance of Kernel
|-------------------------------------------------------
*/
//$kernel = $app->get(Jan\Contracts\Http\Kernel::class);



/*
|-------------------------------------------------------
|    Get Response
|-------------------------------------------------------
*/

//$response = $kernel->handle(
//    $request = \Jan\Component\Http\Request::createFromGlobals()
//);


//dump($response);

/*
|-------------------------------------------------------
|    Send all headers to navigator
|-------------------------------------------------------
*/

// $response->send();


/*
|-------------------------------------------------------
|    Terminate
|-------------------------------------------------------
*/

// $kernel->terminate($request, $response);


// dump($app);


# ROUTING
require_once __DIR__.'/../routes/web.php';

$router = new \Jan\Component\Routing\Router(\Jan\Component\Routing\Route::collections());
$router->addPatterns(\Jan\Component\Routing\Route::patterns());


$route = $router->match($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);

if(! $route)
{
    dump('Route not found!');
    exit();
}

dump($route);
$target = $route['target'];
$matches = $route['matches'];
call_user_func($target, $matches);

?>

<form action="/contact" method="POST">
    <input type="text" name="username" value="">
    <br>
    <button type="submit">Send</button>
</form>
