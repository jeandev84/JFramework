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
Route::get('/article/{slug}/{id}', 'ArticleController@show', 'article.show');
Route::map('GET|POST', '/article/{id}/edit', 'ArticleController@edit', 'article.edit');


Route::map('GET|POST', '/auth/login', 'Auth\\LoginController@index', 'auth.login');
Route::map('GET|POST', '/auth/register', 'Auth\\RegisterController@index', 'auth.register');
Route::get('/auth/logout', 'Auth\\LogoutController@index', 'auth.logout');


Route::get('GET', '/user/profile', 'ProfileController@index', 'user.profile');



/**
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