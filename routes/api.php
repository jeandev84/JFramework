<?php


Route::prefix('api/', function () {

    Route::resource('posts', 'Api\\Controllers\\PostController');
});

//dump(Route::collections());