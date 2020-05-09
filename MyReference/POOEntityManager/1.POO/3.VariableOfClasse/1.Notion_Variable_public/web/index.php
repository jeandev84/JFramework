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


// Affichage de la remise depuis la classe [variable de classe]
echo 'Article::$remise => '. Article::$remise;
echo '<br>';

// Affichage depuis les objets
echo $article_1::$remise;
echo '<br>';
echo $article_2::$remise;


echo '<p>Apres modification de la valeur de la remise</p>';

Article::$remise = 15;

echo 'Article::$remise => '. Article::$remise;
echo '<br>';

// Affichage depuis les objets
echo $article_1::$remise;
echo '<br>';
echo $article_2::$remise;

echo '<p>Apres seconde modification de la valeur de la remise</p>';

Article::$remise = 20;

echo 'Article::$remise => '. Article::$remise;
echo '<br>';

// Affichage depuis les objets
echo $article_1::$remise;
echo '<br>';
echo $article_2::$remise;


echo '<pre>';
var_dump($article_1);
echo '</pre>';

echo '<pre>';
var_dump($article_2);
echo '</pre>';

