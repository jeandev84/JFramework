<?php
require_once __DIR__ . '/debug.php';

/**
 | Inclusion de Fichier
*/
require_once __DIR__ . '/Entity/Client.php';
require_once __DIR__ . '/Entity/Address.php';

use Entity\Client;
use Entity\Address;


$clientA = new Client('Dupond', 'Jean');


$address = new Address();
$address->setStreet('7 rue du moulin rouge');
$address->setPostalCode('75000');
$address->setCity('Paris');


$clientA->setAddress($address);



// ptr($clientA);

ptr($clientA->getAddress());


$addressDuClientDupond = $clientA->getAddress();

echo $addressDuClientDupond->getCity();
echo '<br/>';

echo $addressDuClientDupond->getPostalCode();

echo '<br/>';

echo $clientA->getAddress()->getCity();


$address->setCity('Dijon');
ptr($clientA);



$clientA->getAddress()->setCity('Rennes');
ptr($address);