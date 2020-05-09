<?php 
/**
 | Inclusion de Fichier
*/
require_once '/Entity/Client.php';

use Entity\Client;

/**
 * Methode Chainage
*/

$article = new Article();

$currentObj = $article->setName('nom du produit')
                      ->setDescription('description bidon')
                      ->setPrice(452.36);

echo '<pre>';
var_dump($currentObj);
echo '</pre>';


