<?php 
/**
 | Inclusion de Fichier
*/
require_once '../src/App/Entity/Article.php';

use App\Entity\Article;


$article_1 = new Article();
$article_1->setTradeName('article 1');

$article_2 = new Article();
$article_2->setTradeName('article 2');

$article_1->setPrice(100);
$article_2->setPrice(200);



echo Article::REMISE_MAX;
echo '<br>';

echo Article::REMISE_MAX();



echo '<pre>';
var_dump($article_1);
echo '</pre>';

echo '<pre>';
var_dump($article_2);
echo '</pre>';
