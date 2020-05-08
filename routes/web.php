<?php

/*
 | -----------------------------------------------------------------
 |  Registre all web application
 | -----------------------------------------------------------------
*/


Route::get('/', 'SiteController@index', 'app.home')
->middleware([
    App\Middlewares\DemoMiddleware::class,
    App\Middlewares\PageNotFoundMiddleware::class
]);

Route::get('/about', 'SiteController@about', 'app.about');
Route::map('GET|POST', '/contact', 'SiteController@contact', 'app.contact');



Route::get('/articles', 'ArticleController@index', 'article.list');
Route::get('/article/{slug}/{id}', 'ArticleController@show', 'article.show');
Route::map('GET|POST', '/article/{id}/edit', 'ArticleController@edit', 'article.edit');


$options = [
  'prefix' => '',
  'middleware' => [
      \App\Middlewares\Authenticated::class
  ]
];


Route::group($options, function () {

    Route::get('/dashboard', 'Admin\\DashboardController@index', 'admin.dashboard.index');
    Route::get('/auth/logout', 'Auth\\LogoutController@index', 'auth.logout');
});

Route::map('GET|POST', '/auth/login', 'Auth\\LoginController@index', 'auth.login');
Route::map('GET|POST', '/auth/register', 'Auth\\RegisterController@index', 'auth.register');



Route::get('/user/profile', 'ProfileController@index', 'user.profile');



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