<?php
namespace Jan\DI\Contracts;


/**
 * interface ContainerInterface
 * @package Jan\DI\Contracts
*/
interface ContainerInterface
{

     /**
      * Get id from container
      * @param $id
      * @return mixed
     */
     public function get($id);


     /**
      * Determine if given id is set in container
      * @param $id
     */
     public function has($id);
}