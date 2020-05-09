<?php 
namespace Entity;


/**
 * @package \App\Entity\Customer
 * 
 * Collection est un groupe d'objets de meme type
*/
class Customer
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
         * Tableau de type Address
         * @var Array $addressCollection 
         * 
        */
        private $addressCollection;
        


        
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
             $this->addressCollection = [];

             $this->lastName  = $lastName;
             $this->firstName = $firstName;
             $this->createdAt = new \Datetime('now');
             $this->code = $this->getHash();
        }


        
        /**
         * Permet d'ajouter une collection d'address a la l'address du client
         * @param Address $address 
         * @return true en cas de success, false si l'objet est deja dans la collection
         */
        public function addAddress(Address $address)
        {
              if(in_array($address, $this->addressCollection, true))
              {
                  return false;
              }

              $this->addressCollection[] = $address;
              return true;
        }

        
        /**
         * Suppression d'une adresse de la collection d'adresse
         * @param Address $address 
         * @return bool [true si l'address est supprimmee, false dans le cas contraire]
         */
        public function removeAddress(Address $address)
        {
            
            # retourne la cle associee dans le tableau de collection d'address
            $key = array_search($address, $this->addressCollection, true);

            if($key === false)
            {
                return false;
            }

            unset($this->addressCollection[$key]);
            return true;
        }

 
        
        /**
         * Retourne une collection d'objets de type Address
         * @return Array
         */
        public function getAddressCollection()
        {
             return $this->addressCollection;
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