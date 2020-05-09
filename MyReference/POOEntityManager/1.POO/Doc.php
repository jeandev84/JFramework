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
	        * @var string $reference Reference du produit
	        * @var string $tradeName  nom commercial du produit
	        * @var string  $description Description de l'article
	       */
	       private $reference, $tradeName, $description;
}