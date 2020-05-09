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


Article::setRemise('20.3');

echo Article::getRemise();


$priceForArticle_1 = 200; // -150 ne sera pas affecte a la propriete price car il est negatif

$article_1->setPrice($priceForArticle_1);


/*
$priceIsOk = Article::isPositive($priceForArticle_1);

if($priceIsOk)
{
	echo '<br>';
	echo 'Le prix propose '. $priceForArticle_1 .' est valide';
	$article_1->setPrice($priceForArticle_1);

}else{
    echo '<br>';
	echo 'Le prix propose  n \' est valide, il doit etre positif';
}

*/


echo '<pre>';
var_dump($article_1);
echo '</pre>';

echo '<pre>';
var_dump($article_2);
echo '</pre>';

