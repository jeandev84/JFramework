<?php 
namespace App\Entity;



class Article 
{ 
        
        /**
         * Name of article
         * @var string 
        */
        private $name;  


        public function setName($name)
        {
             $this->name = $name;
        }


        public function setPrice($price)
        {
        	 $this->price = $price;
        }
           
}