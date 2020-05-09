<?php 
namespace Project;


class Hash
{
	
	  public static function make($string, $salt = '')
	  {
            return hash('sha256', $string . $salt);
	  }
      
      # TO BE FIX
	  public static function salt($length = null)
	  {
              if(version_compare(PHP_VERSION, '7.1.0', '<'))
              {
              	   return mcrypt_create_iv($length, MCRYPT_DEV_RANDOM);
              }
	  	      
	  	      // return bin2hex($length);
                
              # 'QwYhswY&HyuijWOpbTgdz$YpsgbrvckUl'
	  	      return Config::get('hash/salt');
	  }

	  public static function unique()
	  {
          return self::make(uniqid());
	  }

	  public static function passwordHash($string = '', $const = PASSWORD_DEFAULT, $options = [])
	  {
	  	    return password_hash($string, $const, $options);
	  }


	  public static function passwordVerify($password, $hash)
	  {
	  	    return password_verify($password, $hash);
	  }


	 
}

/**
 * https://stackoverflow.com/questions/4099333/how-to-generate-a-good-salt-is-my-function-secure-enough
 * https://hotexamples.com/examples/-/-/generate_salt/php-generate_salt-function-examples.html
 * http://php.net/manual/fr/function.mcrypt-create-iv.php
 *  $size = mcrypt_get_iv_size(MCRYPT_CAST_256, MCRYPT_MODE_CFB);
     $iv = mcrypt_create_iv($size, MCRYPT_DEV_RANDOM);


$password = 'MyPassword';
$salt = 'MySaltThatUsesALongAndImpossibleToRememberSentence+NumbersSuch@7913';
$hash = password_hash($password, PASSWORD_DEFAULT, ['salt'=>$salt]);
  **/