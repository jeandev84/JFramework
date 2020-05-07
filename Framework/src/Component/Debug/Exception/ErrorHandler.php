<?php
namespace Jan\Component\Debug\Exception;


use Exception;

/**
 * Class ErrorHandler
 * @package Jan\Component\Debug\Exception
*/
class ErrorHandler
{

     /** @var Exception */
     protected $error;


     /**
      * ErrorHandler constructor.
      * @param Exception $error
     */
     public function __construct(Exception $error)
     {
         $this->error = $error;
     }


     /** @return mixed */
     public function handle() { }



     /** Log errors for development */
     public function log() {}

}