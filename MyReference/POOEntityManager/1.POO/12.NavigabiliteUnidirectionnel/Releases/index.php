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


# Pas effectif
// $clientA->setAddress('7 rue du moulin rouge 75000 Paris');

$clientA->setStreet('7 rue du moulin rouge');
$clientA->setPostalCode('75000');
$clientA->setCity('Paris');


ptr($clientA);