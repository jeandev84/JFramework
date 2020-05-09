<?php 
namespace Entity;



class Address
{

       
        /**
         * rue du client
         * @var string
        */
        private $street;

        
        /**
         * code postal du client
         * @var string
        */
        private $postalCode;



        /**
         * ville du client
         * @var string
        */
        private $city;


        public function __construct($street, $postalCode, $city)
        {
               $this->street = $street;
               $this->postalCode = $postalCode;
               $this->city = $city;
        }


	    /**
         * @param string $street 
         * @return void
        */
        public function setStreet($street)
        {
             $this->street = $street;
        }

        /**
         * @return string
        */
        public function getStreet()
        {
             return $this->street;
        }


        /**
         * @param string $postalCode 
         * @return void
        */
        public function setPostalCode($postalCode)
        {
             $this->postalCode = $postalCode;
        }

        /**
         * @return string
        */
        public function getPostalCode()
        {
             return $this->postalCode;
        }


        /**
         * @param string $city 
         * @return void
        */
        public function setCity($city)
        {
             $this->city = $city;
        }

        /**
         * @return string
        */
        public function getCity()
        {
             return $this->city;
        }


}