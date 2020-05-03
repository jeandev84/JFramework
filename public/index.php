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


try {

    $dotenv = (new \Jan\Component\Dotenv\Env(__DIR__.'/../'))
              ->load();

} catch (Exception $e) {

    die($e->getMessage());
}

echo getenv('APP_NAME');
dump($dotenv['DB_NAME']);
echo $_ENV['DB_NAME'];

$_ENV['new'] = 'test';
dump($_ENV);