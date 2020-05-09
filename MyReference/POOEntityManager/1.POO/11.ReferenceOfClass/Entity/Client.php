<?php 
namespace Entity;


/**
 * @package \App\Entity\Client
*/
class Client
{

       /**
         * nom du Client
         * @var string $lastName
        */
        private $lastName;  


        /**
         * prenom du client
         * @var string $firstName
        */
        private $firstName;

        
        /**
         * Date de creation du client
         * @var datetime $createdAt
        */
        private $createdAt;

        
        /**
         * code client
         * @var string $code
        */
        private $code;


        
        /**
         * @param string $lastName 
         * @return void
        */
        public function setLastName($lastName)
        {
             $this->lastName = $lastName;
        }

        /**
         * @return string
        */
        public function getLastName()
        {
        	 return $this->lastName;
        }



        /**
         * @param string $firstName 
         * @return void
        */
        public function setFirstName($firstName)
        {
             $this->firstName = $firstName;
        }

        /**
         * @return string
        */
        public function getFirstName()
        {
             return $this->firstName;
        }


        /**
         * @param \Datetime $createdAt 
         * @return void
        */
        public function setCreatedAt(Datetime $createdAt)
        {
             $this->createdAt = $createdAt;
        }

        /**
         * @return string
        */
        public function getCreatedAt()
        {
             return $this->createdAt;
        }



        /**
         * @param string $code 
         * @return void
        */
        public function setCode($code)
        {
             $this->code = $code;
        }

        /**
         * @return string
        */
        public function getCode()
        {
             return $this->code;
        }


        /**
         * Client constructor
         * METHODE MAGIQUE car elle est AUTOMATIQUEMENT appelee 
         * lors de l'instanciation de Client
         * 
         * @param string $lastName
         * @param string $firstName
        */
        public function __construct($lastName = '', $firstName = '')
        {
             $this->lastName  = $lastName;
             $this->firstName = $firstName;
             $this->createdAt = new \Datetime('now');
             $this->code = $this->getHash();
        }

        
        /**
         * Genere un hash a partir du nom et du prenom
         * @return string
         */
        private function getHash()
        {
            return sha1($this->lastName . $this->firstName);
        }

}