<?php 

require_once __DIR__ . '/debug.php';

// ptr($_POST);

// ouverture d'une connexion a la bdd agenda
$objectPdo = new PDO('mysql:host=localhost;dbname=agenda', 'root', '');


// preparation de la requete d'insertion (SQL)
$pdoStmt = $objectPdo->prepare('INSERT INTO contact VALUES (NULL, :nom, :prenom, :tel, :email)');


// on lie chaque marqueur a une valeur
$pdoStmt->bindValue(':nom', $_POST['lastName'], PDO::PARAM_STR);
$pdoStmt->bindValue(':prenom', $_POST['firstName'], PDO::PARAM_STR);
$pdoStmt->bindValue(':tel', $_POST['phone'], PDO::PARAM_STR);
$pdoStmt->bindValue(':email', $_POST['email'], PDO::PARAM_STR);


// execution de la requete preparee
$insertIsOk = $pdoStmt->execute();


if($insertIsOk)
{
	$message = 'Le contact a ete ajoute dans la Bdd';

}else{

	$message = 'Echec de l\' inserstion';
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scal=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>POO BDD</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
   <div class="container" style="margin-top: 40px;">

   	   <h1>Insertion des contacts</h1>
	   
	   <p><?= $message ?></p>

   </div>
</body>
</html>



