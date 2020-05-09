<?php 
/**
 | Inclusion de Fichier
*/
require_once __DIR__ . '/Entity/Client.php';

use Entity\Client;


/**
 * A savoir :
 * Le destructeur sera appele meme si l'execution du script
 * est stoppee en utilisant la fonction exit()
 * Il n'est pas possible de lancer une exception depuis un destructeur
*/
$clientA = new Client('Dupond', 'Jean');


// contenu de l'objet cree
echo '<pre>';
print_r($clientA);
echo '</pre>';


// on cree une deuxieme reference a l'objet
$clientBis = $clientA; # Essayer de commenter la ligne pour voir le comportement


// destruction de la premiere reference a notre objet
unset($clientA);


echo '<p>Il y a encore une reference a l\'objet</p>';


unset($clientBis);


echo '<p>Ceci est la fin du script</p>';