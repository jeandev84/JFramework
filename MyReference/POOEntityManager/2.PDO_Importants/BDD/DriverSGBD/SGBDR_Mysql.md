
# UTILISATION du SGBDR MYSQL 

# connexion a Mysql
$connexion = mysqli_connect("serveur", "utilisateur", "mot_de_passe", "nom_DB")


# execution d'une requete
$result = mysqli_query($mysqli, "SELECT * FROM livre");


# fermeture de la connexion

Mysql_close($connexion)