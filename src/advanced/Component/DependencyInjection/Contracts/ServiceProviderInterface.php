<?php
namespace Jan\Component\DependencyInjection\Contracts;


/**
 * Interface ServiceProviderInterface
 * @package Jan\Component\DependencyInjection\Contracts
*/
interface ServiceProviderInterface
{
     /**
      * Register service in container
      * @return mixed
     */
     public function register();
}