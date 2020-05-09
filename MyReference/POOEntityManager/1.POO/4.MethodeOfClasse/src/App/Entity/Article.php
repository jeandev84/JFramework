<?php 
namespace App\Entity;



class Article 
{ 
          
          
           // Variable de classe
           private static $remise = 10;

           
           // Mutateur pour une propriete de classe
           public static function setRemise($remise)
           {
           	    self::$remise = (int) $remise;
           }

           // Accesseur pour une propriete de classe
           public static function getRemise()
           {
           	    return self::$remise;
           }

           
           // Get Price after Discount
           public function getPriceAfterDiscount()
           {
           	   // return $this->price * (1 - self::$remise / 100);
           	   return $this->price * (1 - self::getRemise() / 100);
           }

     
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
           	   $this->price = self::isPositive($price) ? $price : null;
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
            * Verify si une valeur est positive
            * @return type
            */
           public static function isPositive($price)
           {
                  return ($price >= 0) ? true : false;
           }

}