<?php 
namespace App\Entity;



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
         * prefix code of article
         * @var string description
        */
        private const CODE_PREFIX = 'shop_';

        
        /**
         * Set name of article
         * @param string $name 
         * @return void
        */
        public function setName($name)
        {
             $this->name = $name;
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
        	 return md5(self::CODE_PREFIX . $this->name);
        } 
}