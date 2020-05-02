<?php

use Jan\Component\Routing\Route;


Route::get('/', function () {

    echo 'Welcome';

}, 'home');




Route::map('GET|POST', '/contact', function () {

    if ($_SERVER['REQUEST_METHOD'] == 'GET') {

        echo 'Formulaire de contact!';
        dump($_GET);
    }else{

        echo 'Message a ete envoye!';
        dump($_POST);
    }
});