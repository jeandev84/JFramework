<?php 

require_once __DIR__ . '/debug.php';


// ouverture d'une connexion a la bdd agenda
$objectPdo = new PDO('mysql:host=localhost;dbname=agenda', 'root', '');


// preparation de la requette
$pdoStmt = $objectPdo->prepare('SELECT * FROM contact WHERE id = :num');


// liaison du parametre nomme
$pdoStmt->bindValue(':num', $_GET['numContact'], PDO::PARAM_INT);


// execution de la requete
$executeIsOk = $pdoStmt->execute();


// on recupere le contact
$contact = $pdoStmt->fetch();


?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scal=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Form Modification</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
   <div class="container" style="margin-top: 40px;">

   	   <h1>Modifier un contact</h1>
	   <form action="modifier.php" method="POST">
	   	   
	   	    <input type="hidden" name="numContact" value="<?= $contact['id'] ?>">
	   	    
	   	    <div class="form-group">
	   	    	<label for="nom">Nom</label>
	   	    	<input type="text" id="nom" name="firstName" class="form-control" value="<?= $contact['nom'] ?>">
	   	    </div>

	   	    <div class="form-group">
	   	    	<label for="prenom">Prenom</label>
	   	    	<input type="text" id="prenom" name="lastName" class="form-control" value="<?= $contact['prenom'] ?>">
	   	    </div>


	   	    <div class="form-group">
	   	    	<label for="tel">Telephone</label>
	   	    	<input type="text" id="tel" name="phone" class="form-control" placeholder="* 10 caracteres maximum" value="<?= $contact['tel'] ?>">
	   	    </div>

	   	    <div class="form-group">
	   	    	<label for="email">Adresse Electronique</label>
	   	    	<input type="email" id="email" name="email" class="form-control" value="<?= $contact['email'] ?>">
	   	    </div>

	   	    <p><input type="submit" value="Enregistrer les modifications" class="btn"></p>
	   </form>
       <a href="lister.php">Voir la liste des contacts</a>
   </div>
</body>
</html>


