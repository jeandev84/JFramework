<?php 

# Une Entite, c'est une classe
# avec des proprietes dont l'une est un indentifiant
# avec des setters et getters mais pas de setter pour l'identifiant
# et avec d'autres methodes d'objet ou de classe si besoin



class Client
{

	  private $id;
	  private $prenom;


	  public function getId()
	  {
	  	  return $this->id;
	  }


	  public function getPrenom()
	  {
	  	  return $this->prenom;
	  }


	  public function setPrenom($prenom)
	  {
	  	  $this->prenom = $prenom;
	  }
}


# Chaque instance correspond a une ligne de la table dans la base de donnees

# C'est le manager d'entite qui etablit le lient entre une entite et la base de donnee


$client_1 = new Client();
$client_1->setPrenom('Alfred');


$client_2 = new Client();
$client_2->setPrenom('Vincent');


$client_3 = new Client();
$client_3->setPrenom('Claude');



// Stockage des Objets en Bdd
$clientManager = new ClientManager();

$clientManager->save($client_1);
$clientManager->save($client_2);
$clientManager->save($client_3);