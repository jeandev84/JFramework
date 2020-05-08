<?php


# FILESYSTEM
$filesystem = new \Jan\Component\FileSystem\FileSystem(__DIR__ . '/FileSystem/');
dump($filesystem->resource('templates/views'));
# "/var/www/JFramework/public/../templates/views"


dump($filesystem->load('config/app.php'));
/*
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

# FILE STORAGE
$fileStorage = new \Jan\Component\FileSystem\FileStorage(__DIR__ . '/FileSystem/');
$fileStorage->withStorageKey('somestuff');
dump($fileStorage);

/*
Jan\Component\FileSystem\FileStorage {#9
  #storageKey: "somestuff"
  #resource: "/var/www/JFramework/public/../"
}
*/