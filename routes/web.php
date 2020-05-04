<?php

/*
 | -----------------------------------------------------------------
 |  Registre all web application
 | -----------------------------------------------------------------
*/


Route::get('/', 'SiteController@index', 'app.home');
Route::get('/about', 'SiteController@about', 'app.about');
Route::map('GET|POST', '/contact', 'SiteController@contact', 'app.contact');



Route::get('/articles', 'ArticleController@index', 'article.list');
//Route::get('/article/{slug}/{id}', 'ArticleController@show', 'article.show');
Route::get('/article/{slug}/{id}', 'ArticleController@show', 'article.show');
Route::map('GET|POST', '/article/{id}/edit', 'ArticleController@edit', 'article.edit');


Route::map('GET|POST', '/auth', 'Auth\\LoginController@index', 'auth.login');


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

*/