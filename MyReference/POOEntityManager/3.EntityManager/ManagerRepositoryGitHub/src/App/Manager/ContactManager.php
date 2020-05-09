<?php 
namespace App\Manager;


use PDO;
use App\Entity\Contact;



class ContactManager
{

      /**
       * @var \PDO $pdo
       * PDO lie a la base de donnees "agenda".
       * Comme la "connexion" va etre utilisee dans plusieurs
       * methodes , il est utile de la stocker dans une variable d'objet
       * 
      */
      private $pdo;


      /**
       * @var \PDOStatement $pdoStatement objet PDOStatement resultant de l'utilisation des methodes PDO::query et PDO::prepare, PDOStatement est un objet utile dans bien des circonstances, donc le stocker dans une variable va permettre son utilisation dans differentes methodes le cas echeant.
       * 
      */
      private $pdoStatement;



      /**
       * Contact constructor.
       * Initialisation de la connexion a la base de donnees
       */
      public function __construct()
      {
            $this->pdo = new PDO('mysql:host=localhost;dbname=agenda', 'root', '');
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo->exec('SET NAMES utf8');
      }

      
      /**
       * Insere un objet Contact dans la bdd 
       * Et met ajour l'objet passe en argument en lui specifiant un identifiant
       * 
       * @param Contact $contact objet de type Contact passe par reference
       * 
       * @return bool true si l'objet a ete insere, false si une erreur survient
       */
       private function create(Contact &$contact)
       {
            $this->pdoStatement = $this->pdo->prepare('INSERT INTO contact VALUES (NULL, :nom, :prenom, :tel, :email)');
           

            // liaison des parametres
            $this->pdoStatement->bindValue(':nom', $contact->getNom(), PDO::PARAM_STR);
            $this->pdoStatement->bindValue(':prenom', $contact->getPrenom(), PDO::PARAM_STR);
            $this->pdoStatement->bindValue(':tel', $contact->getTel(), PDO::PARAM_STR);
            $this->pdoStatement->bindValue(':email', $contact->getEmail(), PDO::PARAM_STR);


            // execution de la requette
            $executeIsOk = $this->pdoStatement->execute();

            if(!$executeIsOk)
            {
            	// die('PAS OK');
            	return false;

            }else{
                
                $id = $this->pdo->lastInsertId();
                $contact = $this->read($id);
                
            	return true;
            }
       }


       
       /**
        * Recupere un objet Contact a partir de son identifiant
        * 
        * @param int $id Identifiant d'un contact
        *
        * @return bool|Contact|null false si une erreur survient, un objet Contact si une correspondance est trouvee, NULL s'il n'y a aucune correspondance
       */
       public function read($id)
       {
           $this->pdoStatement = $this->pdo->prepare('SELECT * FROM contact WHERE id = :id');

           // liaison des parametres
           $this->pdoStatement->bindValue(':id', $id, PDO::PARAM_INT);
           
           // execution de la requette
           $executeIsOk = $this->pdoStatement->execute();

            
            if($executeIsOk)
            {
            	  // recuperation de notre resultat
            	  $contact = $this->pdoStatement->fetchObject('App\Entity\Contact');


            	  if($contact === false)
            	  {
            	  	  return null;

            	  }else{

            	  	 return $contact;
            	  }


            }else{
                  
                  // erreur d'execution
            	  return false;
            }

       }

       
       /**
        * Recupere tous les objets Contact de la bdd
        * 
        * @return array|bool tableau d'objets Contact ou un tableau vide s'il n'y a aucun objet dans la bdd, ou false si une erreur survient
       */
       public function readAll()
       {
           $this->pdoStatement = $this->pdo->query('SELECT * FROM contact ORDER BY nom, prenom');

           // construction d'un tableau d'objets de type Contact

           $contacts = [];

           while($contact = $this->pdoStatement->fetchObject('App\Entity\Contact'))
           {
           	    $contacts[] = $contact;
           }
           
           // ptr($contacts);
           return $contacts;
       }


       /**
        * Met ajour un objet stocke en BDD
        * 
        * @param Contact $contact objet de type Contact
        * 
        * 
        * @return bool true en cas de succes ou false en cas d'erreur
       */
       private function update(Contact $contact)
       {
             $this->pdoStatement = $this->pdo->prepare('UPDATE contact SET nom = :nom, prenom = :prenom, tel = :tel, email = :email WHERE id = :id LIMIT 1');

            // liaison des parametres
            $this->pdoStatement->bindValue(':nom', $contact->getNom(), PDO::PARAM_STR);
            $this->pdoStatement->bindValue(':prenom', $contact->getPrenom(), PDO::PARAM_STR);
            $this->pdoStatement->bindValue(':tel', $contact->getTel(), PDO::PARAM_STR);
            $this->pdoStatement->bindValue(':email', $contact->getEmail(), PDO::PARAM_STR);
            $this->pdoStatement->bindValue(':id', $contact->getId(), PDO::PARAM_INT);


            // execution de la requete
            return $this->pdoStatement->execute();
       }


       
       /**
        * Supprime un objet stocke en BDD
        * 
        * @param Contact $contact objet de type Contact
        * 
        * 
        * @return bool true en cas de succes ou false en cas d'erreur
       */
       public function delete(Contact $contact)
       {
           $this->pdoStatement = $this->pdo->prepare('DELETE FROM contact WHERE id = :id LIMIT 1');

            // liaison des parametres
            $this->pdoStatement->bindValue(':id', $contact->getId(), PDO::PARAM_INT);

            // excecution de la requette
            return $this->pdoStatement->execute();
       }



       /**
       * Insere un objet en bdd et met a jour l'objet passee en argument en lui specifiant un identifiant ou le met simplement a jour dans la bdd s'il en est issu
       * 
       * 
       * @param Contact $contact objet Contact passe par reference
       * 
       * 
       * @return bool true en cas de success ou false en cas d'erreur
       */
       public function save(Contact &$contact)
       {
             // il faut utiliser la methode create lorsqu'il s'agit d'un nouvel objet
       	     // et la methode Update lorsque l'objet n'est pas nouveau
       	     // Comment le savoir 
       	     // Un nouvel objet n'a pas d'id
       	     // Un objet issu de la bdd a un id

       	      if(is_null($contact->getId()))
       	      {
                   return $this->create($contact);

       	      }else{

       	      	  return $this->update($contact);
       	      }
       }
    
}