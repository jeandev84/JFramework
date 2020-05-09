<?php 
/**
 | Inclusion de Fichier
*/
require_once '../src/App/Entity/Article.php';

use App\Entity\Article;


$article_1 = new Article();

$article_1->setPrice(100);
$article_1->increasePrice(5);
$article_1->decreasePrice(10);

$article_1->setTradeName('Clavier ultraplat noir en plastique');
$article_1->autoAssignementReference();


echo '<pre>';
var_dump($article_1);
echo '</pre>';


$article_2 = new Article();


$article_2->setPrice(200);
$article_2->increasePrice(10);


echo '<pre>';
var_dump($article_2);
echo '</pre>';
