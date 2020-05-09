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


// il faut recuperer le contact a mettre a jour a partir de l'id passe dans l'url
$contactManager = new ContactManager();

$contact = $contactManager->read($_POST['id']);


$contact->setNom($_POST['lastName']);
$contact->setPrenom($_POST['firstName']);
$contact->setTel($_POST['phone']);
$contact->setEmail($_POST['email']);


// On ne touche pas a l'id du contact car il est gere en bdd. De toutes facons, aucun setter n'a ete defini pour cette propiete.

// mise a jour de l'objet Contact

$saveIsOk = $contactManager->save($contact);

if($saveIsOk)
{
 	 $message = 'Le contact a ete mise a jour';

}else{

 	 $message = 'Le contact n\' a pas ete modifie';
}

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

   	   <h1>Mise a jour d'un contact</h1>
	   
	   <p><?= $message ?></p>

   </div>
</body>
</html>
