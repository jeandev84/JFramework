# PDO: http://php.net/manual/fr/class.pdo.php 



PHP Data Objets : Interface d'access a une Base de donnees

Si on utilise Mysql, l'utilisation de cette BDD est differente de l'utilisation d'une BDD realisee avec le SGBDR PostgreSQL.

PDO permet d'unifier le travail (presque) independament du SGBDR utilise.

Donc si nous en changeons, le travail de maintenance sera grandement facilite

# ==========================================================================

Ces eceuils sont evites grace a PDO


PDO fournit une interface d'abstraction a l'access de donnees, 
ce qui signifie que vous utilisez les memes fonctions pour executer des requettes
ou recuperer les donnees quelle que soit la base de donnees utilisee


PDO ne permet pas d'ecrire des requettes qui sont independes du SGBR utilise.
Chaque SGBDR a ses specificites SQL.

# =================================================================

Lorsque l'on utilise executer une requette de type SELECT, il faut utiliser la methode <<query>>


public function query(string $statement): PDOStatement

Si l'on utilise la methode <<query>>, nous aurons pour valeur de retour 
un object PDOStatement (donc il ne s'agit pas du resultat de la requete!)


Cet Objet permet alors d'utiliser toutes les methodes de la classe PDOStatement 


il faut alors connaitre la classe PDOStatement(du moins, comprendre sa documentation)


