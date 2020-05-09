<?php 


# GET REQUEST
Route::get('/', 'HomeController@index')->with(['id' => 1, 'slug' => 'home-work']);
Route::get('/about', 'HomeController@about');
Route::get('/contact', 'HomeController@login');


# POST REQUEST
Route::post('/contact', 'HomeController@login');



Route::getRoutes();
