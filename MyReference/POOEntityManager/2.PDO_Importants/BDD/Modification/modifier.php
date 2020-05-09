<?php 

require_once __DIR__.'/debug.php';


// ouverture d'une connexion a la bdd agenda
$objectPdo = new PDO('mysql:host=localhost;dbname=agenda', 'root', '');


// preparation de la requette
$pdoStmt = $objectPdo->prepare('UPDATE contact SET nom = :nom, prenom = :prenom, tel = :tel, email = :email WHERE id = :num LIMIT 1');


// on lie chaque marqueur a une valeur
$pdoStmt->bindValue(':num', $_POST['numContact'], PDO::PARAM_STR);
$pdoStmt->bindValue(':nom', $_POST['lastName'], PDO::PARAM_STR);
$pdoStmt->bindValue(':prenom', $_POST['firstName'], PDO::PARAM_STR);
$pdoStmt->bindValue(':tel', $_POST['phone'], PDO::PARAM_STR);
$pdoStmt->bindValue(':email', $_POST['email'], PDO::PARAM_STR);


// execution de la requete
$executeIsOk = $pdoStmt->execute();


if($executeIsOk)
{
	$message = 'Le contact a ete mise ajour';

}else{

	$message = 'Echec de la mise ajour du contact';
}



?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scal=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Modification : resultat</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
   <div class="container" style="margin-top: 40px;">
    
   	    <h1>Resultat de la modification</h1>
	    <p><?= $message ?></p>
       <a href="lister.php">Voir la liste des contacts</a>
   </div>
</body>
</html>


