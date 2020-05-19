<?php
namespace App\Services;


/**
 * Class EncoderPassword
 * @package App\Services
*/
class EncoderPassword
{

   /**
     * @param $password
     * @return false|string|null
   */
   public function encode($password)
   {
       return password_hash($password, PASSWORD_BCRYPT);
   }


   /**
     * @param $password
     * @param $hash
     * @return bool
   */
   public function decode($password, $hash)
   {
       return password_verify($password, $hash);
   }
}