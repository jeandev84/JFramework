<?php
namespace Jan\Component\Database\ORM;


use PDO;


/**
 * Class EntityRepository
 * @package Jan\Component\Database\ORM
*/
class EntityRepository extends ActiveRecord
{

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

        $reflectedClass = new \ReflectionClass($this->entity);
        return mb_strtolower($reflectedClass->getShortName()).'s';

    }
}