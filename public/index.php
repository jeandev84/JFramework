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


dump($app);

$requestMethod = $_SERVER['REQUEST_METHOD'];
$method = isset($_POST['_method']) ? $_POST['_method'] : null;

if($method === 'PUT')
{
    $requestMethod = $method;
    parse_str(file_get_contents('php://input'), $_PUT);
    'Put arguments: ';
    unset($_PUT['_method']);
    dump($_PUT);
}

dump($requestMethod);
/*
if ('PUT' === $method) {
    parse_str(file_get_contents('php://input'), $_PUT);
    dump($_PUT); //$_PUT contains put fields
}
*/

dump($app['fileSystem']);
dump($app['fileSystem']);
dump($app['fileSystem']);
dump($app['fileSystem']);

dump($app->make(\App\Foo::class));
dump($app->make(\App\Foo::class));
dump($app->make(\App\Foo::class));
dump($app->make(\App\Foo::class));
?>

<form action="/" method="POST">
    <div>
        <input type="text" name="username">
    </div>
    <div>
        <input type="password" name="password">
    </div>
    <input type="hidden" name="_method" value="PUT">
    <button type="submit">Send</button>
</form>
