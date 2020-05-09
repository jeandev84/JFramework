<?php 

require_once __DIR__ . '/debug.php';


// ouverture d'une connexion a la bdd agenda
$objectPdo = new PDO('mysql:host=localhost;dbname=agenda', 'root', '');


// preparation de la requette
$pdoStmt = $objectPdo->prepare('DELETE FROM contact WHERE id=:num LIMIT 1');


// liaison du parametre nomme
$pdoStmt->bindValue(':num', $_GET['numContact'], PDO::PARAM_INT);


// execution de la requette
$executeIsOk = $pdoStmt->execute();

if($executeIsOk)
{

	$message = 'Le contact a ete supprime';

}else{

	$message = 'Echec de la suppression du contact';

}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scal=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Suppression de contact</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
   <div class="container" style="margin-top: 40px;">

   	   <h1>Suppression de contact</h1>
	   
	   <p><?= $message ?></p>
       <a href="lister.php">Retour a la liste</a>
   </div>
</body>
</html>

