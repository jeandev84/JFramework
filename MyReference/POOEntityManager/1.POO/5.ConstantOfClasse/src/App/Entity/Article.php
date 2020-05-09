<?php 
namespace App\Entity;



class Article 
{ 
          
          
           // Variable de classe
           private static $remise = 10;

           
           /*
             Une constante, c'est comme une propriete de classe mais accessible seulement en lecture.
             Sa valeur ne peut jamais etre modifiee, ni a l'exterieur de la classe, si a l'interieur
             Par defaut une constante est publique
           */
           const REMISE_MAX = 20;


           /**
             PHP 7.1
           */
           private const REMISE_MIN  = 0;
           public  const REMISE_EXCP = 50;
           protected const REMISE_DEF = 5;

           
           /*
            Cette methode permet de retourner une valeur constante qui ne peut pas etre modifiee (comme une constante). Son acces est prive. Donc, cela revient a retourner une valeur privee
           */
           private static function CONST_REMISE_MAX()
           {
           	    return 20;
           }

           
           /*
             Cette methode va permettre un acces public a la constante
             la passer en privee revient au meme que si on avait declare une constante en "private"
           */
           public static function REMISE_MAX()
           {
           	    return self::CONST_REMISE_MAX();
           }



           /**
            * @param float $remise 
            * @return void
            */
           public static function setRemise($remise)
           {
           	    if($remise > self::REMISE_MAX)
           	    {
           	    	  self::$remise = self::REMISE_MAX;

           	    }else{
           	         
           	         self::$remise = $remise;
           	    }
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