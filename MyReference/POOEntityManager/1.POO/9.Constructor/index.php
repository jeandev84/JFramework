<?php 
/**
 | Inclusion de Fichier
*/
require_once __DIR__ . '/Entity/Client.php';

use Entity\Client;

$clientA = new Client('Dupond', 'Jean');

// $clientA->setLastName('Dupond');
// $clientA->setFirstName('Jean');



// contenu de l'objet cree
echo '<pre>';
print_r($clientA);
echo '</pre>';


$clientB = new Client();
$clientB->setLastName('John');
$clientB->setFirstName('Doe');


echo '<pre>';
print_r($clientB);
echo '</pre>';