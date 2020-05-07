<?php
namespace Jan\Component\Database\ORM;



/**
 * Class EntityRepository
 * @package Jan\Component\Database\ORM
*/
class EntityRepository
{

    use ActiveRecord;


    /**
     * @return string
     * @throws \ReflectionException
     */
    protected function tableName()
    {
        if($this->table)
        {
            return $this->table;
        }

        $reflectedClass = new \ReflectionClass($this->entityClass);
        return mb_strtolower($reflectedClass->getShortName()).'s';

    }
}