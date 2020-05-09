<?php 
namespace App\Entity;


/**
 * @package \App\Entity\Contact 
*/
class Contact 
{
      
	       /**
	        * Identifiant du contact (genere automatiquement par le SGBD)
	        * Donc pas de setter a prevoir pour $id
	        * @var int $id
	       */
	       private $id;


	       /**
	        * Nom du contact
	        * @var string $nom
	       */
	       private $nom;


	       /**
	        * Prenom du contact
	        * @var string $prenom
	       */
	       private $prenom;



	       /**
	        * Tel du contact
	        * @var string $tel
	       */
	       private $tel;



	       /**
	        * Adresse de courriel de contact
	        * @var string $email
	       */
	       private $email;

           

           public function getId()
           {
           	   return $this->id;
           }
           
           /**
            * Affecter un nom de contact
            * @param string $nom 
            * @return void
            */
	       public function setNom($nom)
		   {
			    $this->nom = $nom;

			    return $this;
		   }

           
           /**
            * Recuperer le nom du contact
            * @return type
            */
		   public function getNom()
		   {
				return $this->nom;
		   }



		   /**
            * Affecter un prenom de contact
            * @param string $prenom 
            * @return void
            */
	       public function setPrenom($prenom)
		   {
			    $this->prenom = $prenom;

			    return $this;
		   }

           
           /**
            * Recuperer le prenom du contact
            * @return type
            */
		   public function getPrenom()
		   {
				return $this->prenom;
		   }


           /**
            * Affecter un no telephone de contact
            * @param string $tel 
            * @return void
            */
	       public function setTel($tel)
		   {
			    $this->tel = $tel;

			    return $this;
		   }

           
           /**
            * Recuperer le no telephone du contact
            * @return type
           */
		   public function getTel()
		   {
				return $this->tel;
		   }


		   /**
            * Affecter une adresse de courriel de contact
            * @param string $email 
            * @return void
           */
	       public function setEmail($email)
		   {
			    $this->email = $email;

			    return $this;
		   }

           
           /**
            * Recuperer une adresse de courriel de contact
            * @return type
           */
		   public function getEmail()
		   {
				return $this->email;
		   }

}