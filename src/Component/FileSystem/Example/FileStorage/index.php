<?php


# FILE STORAGE
/*
$fileStorage = new \Jan\Component\FileSystem\FileStorage(__DIR__.'/../storage');
echo $fileStorage->getStoragePath('framework/'. md5(123).'.txt');
/var/www/JFramework/public/../storage/cache/framework/202cb962ac59075b964b07152d234b70.txt
*/

$fileStorage = new \Jan\Component\FileSystem\FileStorage(__DIR__.'/../storage');
$fileStorage->withStorageKey('framework');
// dump($fileStorage->generateStoragePath('framework/'. md5(123).'.txt'));

$fileStorage->set('name', 'Jean-Claude');
$fileStorage->set('email', 'jeanyao@ymail.com');
$fileStorage->set(md5(123).'.txt', 'Just a content');


$fileStorage->get('fff');
$fileStorage->get('name');

/*======================================================================*/

$fileStorage = new \Jan\Component\FileSystem\FileStorage(__DIR__.'/../storage');
$fileStorage->set('name', 'Jean-Claude');
$fileStorage->set('email', 'jeanyao@ymail.com');
$fileStorage->set(md5(123).'.txt', 'Just a content');

echo $fileStorage->get('name'); // KEY NOT EXIST
echo $fileStorage->get('email'); // EXIST


$fileStorage->withStorageKey('framework');
$fileStorage->set('app', 'JFramework');
$fileStorage->set('app.config', 'someconfiguration');
echo $fileStorage->get('app');

/*==================================================================*/

# DELETE KEY FROM STORAGE (Default key cache)
$fileStorage->delete('www');
$fileStorage->withStorageKey('framework')->delete('app');
$fileStorage->withStorageKey('cache')->delete('email');