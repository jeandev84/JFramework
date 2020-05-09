<?php 


require_once __DIR__ . '/debug.php';

# Autoloading classes
require_once '../vendor/autoload.php';


// On indique l'espace de nom des classes utilisees
use App\Manager\ContactManager;



// Il faut recuperer le contact a mettre a jour a partir de l'id passe dans l'url
$contactManager = new ContactManager();
$contact = $contactManager->read($_GET['id']);

$deleteIsOk = $contactManager->delete($contact);


if($deleteIsOk)
{
	 $message = 'Le contact a ete supprime';

}else{

	 $message = 'Une erreur est survenue';
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scal=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Suppression d'un contact</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
   <div class="container" style="margin-top: 40px;">

   	   <h1>Suppression d'un contact</h1>
	   
       <p><?= $message ?></p>
   </div>
</body>
</html>
