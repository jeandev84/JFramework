<?php 

require_once __DIR__ . '/debug.php';


// ouverture d'une connexion a la bdd agenda
$objectPdo = new PDO('mysql:host=localhost;dbname=agenda', 'root', '');

// preparation de la requette
$pdoStmt = $objectPdo->prepare('SELECT * FROM contact ORDER BY nom ASC');


// execution de la requete
$executeIsOk = $pdoStmt->execute();


// recuperation des resultats
$contacts = $pdoStmt->fetchAll();

// ptr($contacts);



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

   	   <h1>Lister des contacts</h1>
	   
	    <ul>
	    	<?php foreach($contacts as $contact): ?>
	    		<li>
	    			<?= $contact['nom'] .' '. $contact['prenom'] . ' - ' . $contact['tel'] .' - '. $contact['email'] ?> 
	    			<a href="supprimer.php?numContact=<?= $contact['id'] ?>">Supprimer</a> |
	    			<a href="form_modification.php?numContact=<?= $contact['id'] ?>">Modifier</a>
    			</li>
	    	<?php endforeach; ?>
	    </ul>
        
        <a href="index.php">Retour a l'acceuil</a>
   </div>
</body>
</html>



