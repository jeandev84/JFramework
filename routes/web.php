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




# Example
$options = [
  'prefix' => '',
  'namespace' => 'Ajax',
  'middleware' => [
      App\Middlewares\ajax::class
  ]
];

Route::group($options, function () {

    // This group will be called only by request xhr (ajax)
    Route::get('/cart', 'Ajax\\CartController@index', 'ajax.cart.index');
    Route::get('/cart/add', 'Ajax\\CartController@add', 'ajax.cart.add');
    Route::get('/product', 'Ajax\\ProductController@index', 'ajax.product.list');
    Route::get('/product/add', 'Ajax\\ProductController@add', 'ajax.product.create');
});


Route::get('/demo', function () {

    return [
        'message' => 'data from array to json.',
        'status' => 'OK'
    ];

    // return null;
    // return 'Привет! как настроение ?';
});


//dd(Route::collections());