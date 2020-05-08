<?php



$fileCache = new \Jan\Component\FileSystem\FileCache(
    __DIR__.'/../bootstrap/'
);

$fileCache->set('app.name', 'JFramework');
echo $fileCache->get('app.name');

$fileCache->set('database', require __DIR__.'/../config/app.php');
dump($fileCache->get('database'));

//$fileCache->delete('database');

//$fileCache->destroy();



/*
JFramework
^ array:3 [▼
  "name" => "Jean"
  "debug" => true
  "db" => array:5 [▼
    "host" => "127.0.0.1"
    "database" => "homestand"
    "username" => "root"
    "password" => ""
    "options" => []
  ]
]
*/
