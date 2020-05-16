<?php
namespace App\Services;


/**
 * Class SimpleEmailSender
 * @package App\Services
*/
class SimpleEmailSender
{
   public function __construct()
   {
   }

   /**
     * @param $email
     * @param $subject
     * @param $message
     * @param null $headers
     * @return bool
   */
   public function send($email, $subject, $message, $headers = null)
   {
       if(mail('contact@local.dev', 'Formulaire de contact', $message, $headers))
       {
           return true;
       }else{
           return false;
       }
   }
}