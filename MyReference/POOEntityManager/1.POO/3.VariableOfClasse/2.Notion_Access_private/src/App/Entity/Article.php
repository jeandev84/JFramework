<?php 
namespace App\Entity;



class Article 
{ 
          
          
           // Variable de classe
           private static $remise = 10;


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
            * Get Price After Discount
            * @return float
            */
           public function getPriceAfterDiscount()
           {
           	   // return $this->price * (1 - Article::$remise / 100);
           	   return $this->price * (1 - self::$remise / 100);
           }

}