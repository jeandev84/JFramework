# UTILISATION du SGBDR POSTGRESQL

# connexion a PostgreSQL
$connexion = pg_connect("host=serveur dbname=nom_BDD user=utilisateur password=mot_de_passe")


# execution d'une requete
$result = pg_query($connexion, "SELECT * FROM livre");


# fermeture de la connexion
pg_close($connexion)