<?php 
namespace App\Entity;


/**
 * Fluent or Chainage Methode
 * Return current Object
 * 
 * @package Article
*/
class Article 
{ 
        
        /**
         * Name of article
         * @var string 
        */
        private $name;  


        /**
         * Description of article
         * @var string description
        */
        private $description;

        
        /**
         * Price of article
         * @var float price
        */
        private $price;

        
        
        /**
         * Set name of article
         * @param string $name 
         * @return void
        */
        public function setName($name)
        {
             $this->name = $name;

             return $this;
        }

        /**
         * Get article name
         * @return string
        */
        public function getName()
        {
        	 return $this->name;
        }


        /**
         * Set description of article
         * @param string $description 
         * @return void
        */
        public function setDescription($description)
        {
             $this->description = $description;

             return $this;
        }

        /**
         * Get article description
         * @return string
        */
        public function getDescription()
        {
        	 return $this->description;
        }


        /**
         * Set price of article
         * @param float $price 
         * @return void
        */
        public function setPrice(float $price)
        {
             $this->price = $price;

             return $this;
        }

        /**
         * Get article price
         * @return string
        */
        public function getPrice()
        {
        	 return $this->price;
        }
        
        
        /**
         * Get code
         * @return string
        */
        public function getCode()
        {
        	 if(!$this->name)
        	 {
        	 	 die('Le nom de l\'article doit etre prealablement definit pour avoir son code');
        	 }
        	 return md5($this->name);
        } 
}