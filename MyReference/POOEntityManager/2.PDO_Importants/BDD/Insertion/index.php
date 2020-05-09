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

   	   <h1>Ajouter un contact</h1>
	   <form action="insertion.php" method="POST">
	   	   
	   	    <div class="form-group">
	   	    	<label for="nom">Nom</label>
	   	    	<input type="text" id="nom" name="firstName" class="form-control">
	   	    </div>

	   	    <div class="form-group">
	   	    	<label for="prenom">Prenom</label>
	   	    	<input type="text" id="prenom" name="lastName" class="form-control">
	   	    </div>


	   	    <div class="form-group">
	   	    	<label for="tel">Telephone</label>
	   	    	<input type="text" id="tel" name="phone" class="form-control" placeholder="* 10 caracteres maximum">
	   	    </div>

	   	    <div class="form-group">
	   	    	<label for="email">Adresse Electronique</label>
	   	    	<input type="email" id="email" name="email" class="form-control">
	   	    </div>

	   	    <p><input type="submit" value="Enregistrer" class="btn"></p>
	   </form>

   </div>
</body>
</html>


