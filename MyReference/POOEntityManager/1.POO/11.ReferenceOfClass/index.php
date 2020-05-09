<?php
require_once __DIR__ . '/debug.php';

/**
 | Inclusion de Fichier
*/
require_once __DIR__ . '/Entity/Client.php';

use Entity\Client;


/**
 * REFERENCE
 * Un Objet par defaut est de type reference
 * Identifiant d'objet
*/
$clientA = new Client('Dupond', 'Jean');
// ptr($clientA);



$clientB = $clientA;
// ptr($clientB);


$clientA->setLastName('Martin');
ptr($clientA);
ptr($clientB);



// avec un objet, faire
$clientB = $clientA;

// revient a faire un passage explicite par reference
$clientB = &$clientA;