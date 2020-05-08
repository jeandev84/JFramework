<?php

/*
 | -----------------------------------------------------------------
 |  Registre all web application
 | -----------------------------------------------------------------
*/

# Home
Route::map('GET|POST', '/', 'HomeController@index', 'home');



# Product
Route::get('/product', 'ProductController@index', 'product.list');



# Category
Route::get('/category', 'CategoryController@index', 'category.list');




# Cart
Route::get('/cart', 'CartController@index', 'cart');


# Auth
$options = [
  'prefix' => 'auth/',
  'namespace' => 'Auth'
];

Route::group($options, function () {

    Route::get('/signin/', 'SigninController@index', 'auth.signin');
    Route::get('/signup/', 'SignupController@index', 'auth.signup');
});


Route::get('/logout', 'LogoutController@index', 'logout');


//dd(Route::collections());
