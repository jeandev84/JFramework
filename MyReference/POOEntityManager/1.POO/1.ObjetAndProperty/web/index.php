<?php 
/**
 | Inclusion de Fichier
*/
require_once '../src/App/Entity/Article.php';

use App\Entity\Article;


/**
 | Creation d'un objet INSTANCIATION
 | INSTANCE = objet
*/

$article = new Article();

$article->setReference('AAAA');
$article->setTradeName('Article A');
$article->setDescription('Ici une description');


echo $article->getReference();
echo $article->getDescription();
echo $article->getTradeName();


echo '<pre>';
var_dump($article);
echo '</pre>';

