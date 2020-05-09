<?php
require_once __DIR__ . '/debug.php';

/**
 | Inclusion de Fichier
*/
require_once __DIR__ . '/Entity/Customer.php';
require_once __DIR__ . '/Entity/Address.php';

use Entity\Customer;
use Entity\Address;


// creation d'un client
$client = new Customer('Dupond', 'Jean');


// creation de son addresse de facturation
$addressFacturation = new Address('7 rue du moulin', '75000', 'Paris');

$client->addAddress($addressFacturation);
// $client->addAddress($addressFacturation);

$addressLivraison = new Address('38 Volodarskovo rue', '640000', 'Kurgan');

$client->addAddress($addressLivraison);

// $client->removeAddress($addressFacturation);

ptr($client->getAddressCollection());



foreach ($client->getAddressCollection() as $address)
{
	  ptr($address->getCity());
}
