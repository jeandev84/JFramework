# UNE ENTITE C'EST UNE CLASSE
# avec des proprietes dont l'une est un indentifiant

# avec des setters et getters mais pas de setter pour l'identifiant
# et avec d'autres methodes d'objet ou de classe si besoin
# et c'est une classe qui correspond a une table dans la base de donnees

class Client
{

	  private $id;
	  private $prenom;


	  public function getId()
	  {
	  	  return $this->id;
	  }


	  public function setId($id)
	  {
	  	  $this->id = $id;
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