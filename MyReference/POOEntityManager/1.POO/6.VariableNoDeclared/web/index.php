<?php 
/**
 | Inclusion de Fichier
*/
require_once '../src/App/Entity/Article.php';

use App\Entity\Article;


$article = new Article();

$article->setName('test');

echo '<pre>';
var_dump($article);
echo '</pre>';


$article->setPrice(20);


echo '<pre>';
var_dump($article);
echo '</pre>';


