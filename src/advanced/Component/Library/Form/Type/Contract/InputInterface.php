<?php
namespace Jan\Component\Library\Form\Type\Contract;


/**
 * Interface InputInterface
 * @package Jan\Component\Library\Form\Type\Contract
*/
interface InputInterface
{

     /** @return string */
     public function getType();


     /** @param array */
     public function getAttributes();


     /** @return string */
     public function format();
}