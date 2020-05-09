<?php 
namespace app\controllers;

use app\models\User;
use Project\DB;
use Project\Input;
use Project\Validate;
use Project\Token;
use Project\Session;
use Project\Hash;
use Project\Redirect;



class UserController  extends AppController
{

    public function index()
	{
		$data = [];
       
        $user = new User();

        # Si l'utilisateur n'est pas un administrateur
		if(!$user->hasPermission('admin'))
        {
              // Redirect::to('/'); soit a la page d'acceuil
              // Redirect::to('404');

        	    Redirect::to('404');
        }

		if(Session::exists('success'))
		{
			$data['success'] = Session::flash('success');
		}

		# Session::get(Config::get('session/session_name')) 
        # $user = new \app\models\User();  // current user echo $user->data()->username;
        # $anotheruser = new \app\models\User();  // another user

        
		$this->view('user/index', $data);
	}


	public function login()
	{
		$data = [];

        if(Input::exists())
        {
        	 if(Token::check(Input::get('token')))
        	 {
                  $validate = new Validate();
                  $validation = $validate->check($_POST, [
                     'username' => ['required' => true],
                     'password' => ['required' => true]
                  ]);


                  if($validation->passed())
                  {
                  	  // Log user in
                  	  $user = new User();

                  	  $remember = (Input::get('remember') === 'on') ? true : false;
                  	  $login = $user->login(
                  	  	        Input::get('username'), 
                  	  	        Input::get('password'), 
                  	  	        $remember);


                  	  if($login)
                  	  {
                  	  	 // echo 'Success';
                  	  	  Redirect::to('/'); // to index

                  	  }else{
                         
                         # To replace by session error like it: Session::flash('error', 'msg..');
                         echo 'Sorry! logging is failed!..';
                  	  }

                  }else{

                       $data['error'] = $validate->errorHTML();

                  }
        	 }
            
        }


        $this->view('user/login', $data);
	}


	public function register()
	{
          
          $data = [];

	      if(Input::exists()) // IF POST
	      {
	         
                  // CHECK TOKEN IF MATCHES
     	         if(Token::check(Input::get('token')))
     	         {
                      
                      // echo 'I Have Been Run!';

		         	  $validate = new Validate();
		         	  $validation = $validate->check($_POST, [
		                 'username' => [
		                     'required' => true,
		                     'min' => 2, 
		                     'max' => 20, 
		                     'unique' => 'users'
		                 ],
		                 'password' => [
		                     'required' => true,
		                     'min' => 6
		                 ],
		                 'password_again' => [
		                      'required' => true,
		                      'matches' => 'password'
		                 ],
		                 'name' => [
		                      'required' => true,
		                      'min' => 2,
		                      'max' => 50
		                  ],
		         	    ]);


				         if($validation->passed())
				         {
				             // register user

                              $user = new User();

                              $salt = Hash::salt(); 

                              try 
                              {
                                  
                                  $user->create([
                                      'username' => Input::get('username'),
                                      'password' => Hash::make(Input::get('password'), $salt),
                                      'salt' => $salt,
                                      'name' => Input::get('name'),
                                      'joined' => date('Y-m-d H:i:s'),
                                      'group' => 1
                                  ]);
                                 
                                 Session::flash('home', 'You have been registered and can now log in!');

                                 // Redirect::to(404);
                                 Redirect::to('/');

                              } catch (Exception $e){

                              	  die($e->getMessage());
                              }
				         	  
				         	  // Session::flash('success', 'You registered successfully');
		                      // header('Location: /');

				         }else {

				         	  $data['error'] = $validate->errorHTML();

				         	  //!! Session::flash('error', $validate->errors());
				         }

				    }// verify token
		       
	 
	         } // If not empty POST / GET 

        
        $this->view('user/register', $data);
	}


	public function logout()
	{
         $user = new User();
         $user->logout();

         Redirect::to('/');
	}


	public function update()
	{
		$data = [];

		$user = new User();

		if(!$user->isLoggedIn())
		{
			  Redirect::to('/');
		}
        
        if(Input::exists())
        {
        	 if(Token::check(Input::get('token')))
        	 {
        	 	 // echo 'OK';

        	 	 $validate = new Validate();
        	 	 $validation = $validate->check($_POST, [
                    'name' => ['required' => true, 'min' => 2, 'max' => 50]
        	 	 ]);

        	 	 if($validation->passed())
        	 	 {
        	 	 	  // update
        	 	 	   try
        	 	 	   {
                           $user->update([
                                'name' => Input::get('name')
                           ]);

                           Session::flash('home', 'Your details have been updated.');
                           Redirect::to('/');
                           
        	 	 	   }catch(\Exception $e){

        	 	 	   	   die($e->getMessage());
        	 	 	   }

        	 	 }else{

        	 	 	$data['error'] = $validate->errorHTML();
        	 	 }
        	 }
        }

        # View
		$data['user'] = $user;
		$this->view('user/update', $data);
	}


	public function change()
	{
		$data = [];

		$user = new User();

		if(!$user->isLoggedIn())
		{
			Redirect::to('/');
		}

		if(Input::exists())
		{
			 if(Token::check(Input::get('token')))
			 {
			 	  //echo 'OK!';
			 	   $validate = new Validate();
			 	   $validation = $validate->check($_POST, [
                       'password_current'  => [
                       	    'required' => true, 
                            'min' => 6
                        ],
                       'password_new' => [
                       	    'required' => true, 
                       	    'min' => 6
                       	],
                       'password_new_again' => [
                       	   'required' => true, 
                           'min' => 6, 
                           'matches' => 'password_new'
                       ]
			 	   ]);

			 	   if($validation->passed())
			 	   {
			 	   	    // change of password
			 	   	    if(Hash::make(Input::get('password_current'), $user->data()->salt) !== $user->data()->password)
			 	   	    {
                             
                             echo 'Your current password is wrong.';

			 	   	    }else{

                              // echo 'OK';
       
			 	   	    	  $salt =  Hash::salt(); 
			 	   	    	  $user->update([
                                  'password' => Hash::make(Input::get('password_new'), $salt),
                                  'salt' => $salt
			 	   	    	  ]);

			 	   	    	  Session::flash('home', 'Your password has been changed!');
			 	   	    	  Redirect::to('/');
			 	   	    }

			 	   }else{

                        $data['error'] = $validate->errorHTML();
			 	   }
			 }
		}

	    $this->view('user/change_password', $data);
	}


	public function profile()
	{
          $data = [];

          # S'il n'est pas definit $_GET['user'], alors on redirige l'utilisateur

          if(!$username = Input::get('user'))
          {
          	  Redirect::to('/');

          }else{
              // Verifie si l'user exist
          	  $user = new User($username);

          	  if(!$user->exists())
          	  {
          	  	  Redirect::to(404);

          	  }else{

          	  	 // echo 'exists';
          	  	  $data = $user->data();
          	  }
          }

		  $this->view('user/profile', $data);
	}

}

   

