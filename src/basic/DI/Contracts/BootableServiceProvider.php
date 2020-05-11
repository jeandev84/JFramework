<?php
namespace Jan\DI\Contracts;


/**
 * Interface BootableServiceProvider
 * @package Jan\DI\Contracts
*/
interface BootableServiceProvider
{

     /**
      * Run before registring
      * @return mixed
     */
     public function boot();
}