<?php 
namespace Core\Auth;

use Core\Database\Database;


/**
 * Authentification par Base de donnees
**/
class DBAuth
{
       

       private $db;

       public function __construct(Database $db)
       {
           $this->db = $db;
       }


       public function getUserId()
       {
           if($this->logged())
           {
               return $_SESSION['auth'];
           }

           return false;
       }

       /**
        * Method permettant d'authentifier un utilisateur
        * @param $username
        * @param $password
        * @return boolean
        * dump(sha1('demo'));
       */
       public function login($username, $password)
       {
       	    $sql = 'SELECT * FROM users WHERE username = ?';
            $user = $this->db->prepare($sql, [$username], null, true);
            
            if($user)
            {
                if($user->password === sha1($password))
                {
                     $_SESSION['auth'] = $user->id;
                     return true;
                }

            }

            return false;
       }


       /**
        * Method permettant de savoir 
        * si un utilisateur est authentifie / ou connecte
       */
       public function logged()
       {
       	    return isset($_SESSION['auth']);
       }
}