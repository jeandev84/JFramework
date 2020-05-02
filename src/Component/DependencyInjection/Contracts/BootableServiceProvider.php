<?php
namespace Jan\Component\DependencyInjection\Contracts;


/**
 * Interface BootableServiceProvider
 * @package Jan\Component\DependencyInjection\Contracts
*/
interface BootableServiceProvider
{

     /**
      * Run before registring
      * @return mixed
     */
     public function boot();
}