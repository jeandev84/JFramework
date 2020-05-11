<?php
namespace Jan\DI\Contracts;


/**
 * Interface ServiceProviderInterface
 * @package Jan\DI\Contracts
*/
interface ServiceProviderInterface
{
     /**
      * Register service in container
      * @return mixed
     */
     public function register();
}