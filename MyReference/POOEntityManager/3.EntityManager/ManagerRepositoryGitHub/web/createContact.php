<?php 

require_once __DIR__ . '/debug.php';

/*
On appelle les classes qui vont nous servir
require_once '../src/App/Manager/ContactManager.php';
require_once '../src/App/Entity/Contact.php';
*/

# Autoloading classes
require_once '../vendor/autoload.php';


// On indique l'espace de nom des classes utilisees
use App\Entity\Contact;
use App\Manager\ContactManager;



// creation d'un nouveau contact a partir des donnees du formulaire
$contact = new Contact();

$contact->setNom($_POST['lastName'])
        ->setPrenom($_POST['firstName'])
        ->setTel($_POST['phone'])
        ->setEmail($_POST['email']);


// ptr($contact, true);

 // insertion en bdd via le manager
 $contactManager = new ContactManager();

 $saveIsOk = $contactManager->save($contact);
   
 if($saveIsOk)
 {
 	 $message = 'Le contact a ete ajoute';

 }else{

 	 $message = 'Le contact n\' a pas ete ajoute';
 }

 ?>
 <!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scal=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Ajout d'un Contact</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
   <div class="container" style="margin-top: 40px;">

   	   <h1>Insertion d'un contact</h1>
	   
	   <p><?= $message ?></p>

       <p><a href="index.php">Ajouter un contact</a></p>

   </div>
</body>
</html>
