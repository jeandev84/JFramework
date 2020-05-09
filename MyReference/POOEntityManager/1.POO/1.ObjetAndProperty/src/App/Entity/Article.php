<?php 
namespace App\Entity;



class Article 
{ 
          

	       /**
	        * @var string $reference Reference du produit
	       */  
	       private $reference;


	       /**
	        * @var string $tradeName  nom commercial du produit
	       */
	       private $tradeName;


	       /**
	        * @var string  $description Description de l'article
	       */
	       private $description;

          

           /**
            * Mutateur / setter de la propriete reference
            * @param string $reference
           */
           public function setReference($reference)
           {
           	    if(strlen($reference) > 4)
           	    {
           	    	echo 'La reference '. $reference .' depasse 4 caracteres';

           	    }else{
                    
                    $this->reference = $reference;
           	    }
           }


           /**
            * Accesseur/ Getter de la propriete reference
            * @return string
           */
           public function getReference()
           {
           	   return $this->reference;
           }




           /**
            * Mutateur / setter de la propriete tradeName
            * @param string $tradeName
           */
           public function setTradeName($tradeName)
           {
           	   $this->tradeName = $tradeName;
           }


           /**
            * Accesseur/ Getter de la propriete tradeName
            * @return string
           */
           public function getTradeName()
           {
           	   return $this->tradeName;
           }


           /**
            * Mutateur / setter de la propriete description
            * @param string $description
           */
           public function setDescription($description)
           {
           	   $this->description = $description;
           }


           /**
            * Accesseur/ Getter de la propriete description
            * @return string
           */
           public function getDescription()
           {
           	   return $this->description;
           }

}