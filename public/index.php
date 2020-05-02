<?php

/*
|----------------------------------------------------------------------
|   Load classes and dependencies of application
|----------------------------------------------------------------------
*/


require_once realpath(__DIR__ .'/../vendor/autoload.php');


$container = new \Jan\Component\DependencyInjection\Container();


# Container
dump($container);