<?php 
namespace App\Entity;



class Article 
{ 
          

	       /**
	        * Reference du produit
	        * @var string  $reference
	       */  
	       private $reference;


	       /**
	        * Nom commercial du produit
	        * @var string  $tradeName 
	       */
	       private $tradeName;

           
           /**
            * Prix de l'article
	        * @var float  $price 
	       */
	       private $price;


           /**
             | METHODE D'OBJET : Methode qui agit uniquement sur l'objet courant (designe par $this)
             | C'est le cas des muttateurs et des accesseurs (getteurs et des setters)
           **/

           /**
            * Set reference
            * @param string $reference
           */
           public function setReference($reference)
           {
                $this->reference = $reference;
           }


           /**
            * Get reference
            * @return string
           */
           public function getReference()
           {
           	    return $this->reference;
           }




           /**
            * Set Tradename
            * @param string $tradeName
           */
           public function setTradeName($tradeName)
           {
           	   $this->tradeName = $tradeName;
           }


           /**
            * Get tradename
            * @return string
           */
           public function getTradeName()
           {
           	   return $this->tradeName;
           }


           /**
            * Set description
            * @param string $description
           */
           public function setDescription($description)
           {
           	   $this->description = $description;
           }


           /**
            * Get description
            * @return string
           */
           public function getDescription()
           {
           	   return $this->description;
           }



           /**
            * Set price
            * @param string $price
           */
           public function setPrice($price)
           {
           	   $this->price = $price;
           }


           /**
            * Get price
            * @return string
           */
           public function getPrice()
           {
           	   return $this->price;
           }


           /**
            | D'autres methodes d'objets 
            | C'est a dire d'autres methodes qui vont agir sur l'objet
           **/
            
            /**
             * Methode permettant d' augmenter le prix de l'article
             * @param int $percent %
             * @return void
            */
            public function increasePrice($percent)
            {
            	  $this->price = $this->price * ( 1 + $percent / 100);
            }


            /**
             * Methode permettant de diminuer le prix de l'article
             * @param int $percent %
             * @return void
            */
            public function decreasePrice($percent)
            {
            	 $this->price = $this->price * (1 - $percent / 100);
            }

            
            /**
             * Assign un nom de reference automatiquement
             * @return type
             */
            public function autoAssignementReference()
            {
            	 $this->reference = $this->generateReference();
            }



            /**
             * Mauvaise face de faire en un mot mauvaise approche :
             * Car le nom de la methode n'est pas clair par rapport a ce qui est fait
             * 
             *  public function generateReference()
	            {
	            	  $words = explode(' ', $this->tradeName);
	            	  $letters = '';
	            	  foreach ($words as $word)
	            	  {
	            	  	  $letters .= strtoupper(substr($word, 0, 1));
	            	  }
	                  
	                  $this->reference = $letters;
	            }
            */
            private function generateReference()
            {
            	  $words = explode(' ', $this->tradeName);
            	  $letters = '';
            	  foreach ($words as $word)
            	  {
            	  	  $letters .= strtoupper(substr($word, 0, 1));
            	  }
                  
                  return $letters;
            }


}