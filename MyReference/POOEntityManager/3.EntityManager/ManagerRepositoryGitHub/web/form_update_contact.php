<?php 

require_once __DIR__ . '/debug.php';

# Autoloading classes
require_once '../vendor/autoload.php';


// On indique l'espace de nom des classes utilisees
use App\Manager\ContactManager;



// Il faut recuperer le contact a mettre a jour a partir de l'id passe dans l'url
$contactManager = new ContactManager();

$contact = $contactManager->read($_GET['id']);
   
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scal=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Mise a jour</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
   <div class="container" style="margin-top: 40px;">
     
   	   <h1>Mise Ajour</h1>

   	   <!-- <p><a href="summary.html">Retour au sommaire</a></p> -->
   	   <p><a href="index.php">Retour au sommaire</a></p>

	   <form action="updateContact.php" method="POST">
	   	   
	   	    <div class="form-group">
	   	    	<label for="nom">Nom</label>
	   	    	<input type="text" id="nom" name="firstName" class="form-control" value="<?= $contact->getNom() ?>">
	   	    </div>

	   	    <div class="form-group">
	   	    	<label for="prenom">Prenom</label>
	   	    	<input type="text" id="prenom" name="lastName" class="form-control" value="<?= $contact->getPrenom() ?>">
	   	    </div>


	   	    <div class="form-group">
	   	    	<label for="tel">Telephone</label>
	   	    	<input type="text" id="tel" name="phone" class="form-control" placeholder="* 10 caracteres maximum" value="<?= $contact->getTel() ?>">
	   	    </div>

	   	    <div class="form-group">
	   	    	<label for="email">Adresse Electronique</label>
	   	    	<input type="email" id="email" name="email" class="form-control" value="<?= $contact->getEmail() ?>">
	   	    </div>
            
            <p><input type="hidden" name="id" value="<?= $contact->getId() ?>"></p>
	   	    <p><input type="submit" value="Enregistrer" class="btn"></p>
	   </form>
   </div>
</body>
</html>


