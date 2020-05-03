<?php

$options = [
  'prefix' => 'api/',
  'namespace' => 'Api'
];

Route::group($options, function () {

    Route::get('posts', 'PostController@index');
});

dump(Route::collections());