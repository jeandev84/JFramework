<?php
namespace Jan\Component\Database\ORM;


use ReflectionClass;

/**
 * Class Generator
 * @package Jan\Component\Database\ORM
*/
trait Generator
{

    /**
     * @param string|object $entityClass
     * @return string
     * @throws \ReflectionException
    */
    public function generateNameOfEntityTable($entityClass)
    {
        if(! $entityClass)
        {
            //TODO Review
            $entityClass = static::class; /* get_class($this); */
        }

        $reflectedClass = new ReflectionClass($entityClass);
        return mb_strtolower($reflectedClass->getShortName()).'s';
    }
}