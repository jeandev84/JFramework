<?php

/*
 | -----------------------------------------------------------------
 |  Registre all web application
 | -----------------------------------------------------------------
*/

Route::get('/', function () {

    echo 'Welcome';

}, 'home');


/*
Route::map('GET|POST', '/contact', function () {

    if ($_SERVER['REQUEST_METHOD'] == 'GET') {

        echo 'Formulaire de contact!';
        dump($_GET);
    }else{

        echo 'Message a ete envoye!';
        dump($_POST);
    }
});
*/


$options = ['middleware' => [
  'App\Middleware\Authenticate',
  'App\Middleware\NotValidCredentials'
  ]
];

Route::group($options , function () {

    Route::get('/auth', function () {

        echo 'Auth::run';

    }, 'auth');

});


Route::get('/api', function () {

    return 'Api::run';

}, 'api')->middleware([
    'App\Middleware\NoValidKey'
]);

dump(Route::collections());

$router = new \Jan\Component\Routing\Router(\Jan\Component\Routing\Route::collections());
$router->addPatterns(\Jan\Component\Routing\Route::patterns())
       ->addMiddlewares(\Jan\Component\Routing\Route::middlewares());

$route = $router->match($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);

if(! $route)
{
    dump('Route not found!');
    die;
}

dump(\Jan\Component\Routing\Route::namedRoutes());
dump($route);
call_user_func($route['target'], $route['matches']);
