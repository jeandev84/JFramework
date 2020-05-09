# Essentiel 
L'essentiel, c'est de comprendre l'utilisation de la documentation 


Il y a deux classes:

- La class PDO
  
   dont 2 de ses methodes (prepare et query) retournent un objet PDOStatement:

   <<prepare>> qui permet de prepare une requete pour executer << differee>> (voir le cours porte sur les requetes preparees avec PDO)

   <<query>> qui permet d'executer une requete (traitee des le 3 ieme ou 4ieme cours sur PDO)


- La classe PDOStatement 

   dont les methodes sont accessibles a partir d'un objet PDOStatement( soit le resultat de la methode << query >> ou <<prepare>> dela classe PDO)