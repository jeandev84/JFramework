<?php 

require_once __DIR__ . '/debug.php';


# Autoloading classes
require_once '../vendor/autoload.php';


// On indique l'espace de nom des classes utilisees
use App\Manager\ContactManager;



 // recuperation des contacts
$contactManager = new ContactManager();

$contacts = $contactManager->readAll();
   
?>
 <!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scal=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Lister les contacts</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
   <div class="container" style="margin-top: 40px;">

   	   <h1>Lister tous les contacts</h1>
	   
	   <?php if(empty($contacts)): ?>
          <p>Il n'y a aucun contact a afficher</p>
	   <?php else: ?>
	   	   <?php if($contacts === false): ?>
	   	      <p>Une erreur est survenue</p>
	   	   <?php else: ?>
			   <ul>
			   	 <?php foreach($contacts as $contact): ?>
                    <li>
	    			  <?= $contact->getNom() .' '. $contact->getPrenom() . ' - ' . $contact->getTel() .' - '. $contact->getEmail() ?> - 
	    			  <a href="form_update_contact.php?id=<?= $contact->getId() ?>">Modifier</a> |
	    			  <a href="deleteContact.php?id=<?= $contact->getId() ?>" onclick="confirm('Voulez-vous supprimer ?');">Supprimer</a>
    			   </li>
			   	 <?php endforeach; ?>
			   </ul>
		   <?php endif; ?>
	   <?php endif; ?>

   </div>
</body>
</html>
