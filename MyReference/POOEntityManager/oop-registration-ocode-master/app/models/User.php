<?php 
namespace app\models;

use Project\DB;
use Project\Hash;
use Project\Session;
use Project\Config;
use Project\Cookie;


class User
{

	    private $db, 
	            $data,
	            $sessionName,
	            $cookieName,
	            $isLoggedIn;


	    public function __construct($user = null)
	    {
      	    	$this->db = DB::getInstance();

      	    	$this->sessionName = Config::get('session/session_name');
      	    	$this->cookieName = Config::get('remember/cookie_name');
              
              # IF user doesn't exist
      	    	if(!$user)
      	    	{
      	    		 if(Session::exists($this->sessionName))
      	    		 {
      	    		 	  $user = Session::get($this->sessionName); // current user
      	    		 	  // echo $user;

      	    		 	  if($this->find($user))
      	    		 	  {
      	    		 	  	  $this->isLoggedIn = true;

      	    		 	  }else{

      	    		 	  	  // process logout

      	    		 	  }
      	    		 }

      	    	} else { // IF user exist

                    $this->find($user);
      	    	}


	    }

      
      public function update($fields = [], $id = null)
      {

           if(!$id && $this->isLoggedIn())
           {
               $id = $this->data()->id;
           }

           if(!$this->db->update('users', $id, $fields))
           {
                throw new \Exception("There was a problem updating");
           }
      }

	    public function create($fields = [])
	    {
	    	 if(!$this->db->insert('users', $fields))
	    	 {
                 throw new \Exception('There was a problem creating an account.');
	    	 }
	    }

        
        public function find($user = null)
        {
             if($user)
             {
             	  $field = (is_numeric($user)) ? 'id' : 'username';
             	  $data = $this->db->get('users', [$field, '=', $user]);


             	  if($data->count())
             	  {
             	  	  $this->data = $data->first();
             	  	  return true;
             	  }
             }

             return false;
        }
        
        /**
         * @param string $username
         * @param string $password
         * @param string $remember
         * @return bool
        */
	    public function login($username = null, $password = null, $remember = false)
	    {
  	    	  // dd($this->data, true);
              
              if(!$username && !$password && $this->exists()) // IF
              {
                   // log  user in
                   Session::put($this->sessionName, $this->data()->id);

              }else{

    	    	  $user = $this->find($username);

    	    	  if($user)
                  {
                    if($this->data()->password === Hash::make($password, $this->data()->salt))
                    {
                          // echo 'OK!';
                    	  Session::put($this->sessionName, $this->data()->id);
                         
                          // IF REMEMBER ON FAIT LE TRAITEMENT SUIVANT
                    	  if($remember)
                    	  {
                               $hash = Hash::unique();

                               $hashCheck = $this->db->get('users_session', [
                               	              'user_id', '=', $this->data()->id
                               	           ]);


                                if(!$hashCheck->count())
                                {
                                	$this->db->insert('users_session', [
                                       'user_id' => $this->data()->id,
                                       'hash'    => $hash
                                	]);

                                }else{

                                	 $hash = $hashCheck->first()->hash;
                                }


                                Cookie::put($this->cookieName, $hash, Config::get('remember/cookie_expiry'));

                    	  }

                    	  return true;
                    }

                 }

              }// END IF

              return false;
	    }


      public function hasPermission($role = null) // $role ou $key
      {
           $group = $this->db->get('groups', ['id', '=', $this->data()->group]);
           // dd($group->first());

           if($group->count())
           {
               $permissions = json_decode($group->first()->permissions, true);
               // dd($permissions);

               if($permissions[$role] == true)
               {
                   return true;
               }

           }

           return false;
      }

	    public function exists()
	    {
	    	  return (!empty($this->data)) ? true : false;
	    }
       
        /**
         * @return mixed
        */
        public function logout()
        {
        	 $this->db->delete('users_session', ['user_id', '=', $this->data()->id]);

        	 Session::delete($this->sessionName);
        	 Cookie::delete($this->cookieName);
        }

	    public function data()
	    {
	    	 return $this->data;
	    }

        
	    public function isLoggedIn()
	    {
	    	return $this->isLoggedIn;
	    }
}