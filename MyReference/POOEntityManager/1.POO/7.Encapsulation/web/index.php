<?php 
/**
 | Inclusion de Fichier
*/
require_once '../src/App/Entity/Article.php';

use App\Entity\Article;


/**
 * Encapsulation : proteger l'information contenue dans un objet
 * en ne proposant que des methodes de manipulation de cet objet
 *
 * Ce qui veut dire Les informations contenues dans l'objet 
 * ne sont plus de la responsabilite de l'utilisateur exterieur
 * 
 * L'encapsulation garantie l'integrite des donnees contenues dans l'objet
 * car seules les methodes publiques spnt disponibles. 
 * il y a donc un reel controle sur ce qui peut etre fait avec l'objet manipule.
*/

$article = new Article();

$article->setName('produit test');

echo $article->getCode();

$article->setPrice(10.25);
echo '<br>';
echo $article->getPrice();




