<?php
namespace Jan\Component\Database\ORM;


use Exception;
use ReflectionObject;

/**
 * Trait Mapper
 * @package Jan\Component\Database\ORM
*/
trait Mapper
{

    /**
     * @param object $classMapInstance
     * @return mixed
     * @throws Exception
     */
    public function mapClassProperties(object $classMapInstance)
    {
        $reflectedObject = new ReflectionObject($classMapInstance);
        $properties = [];
        foreach($reflectedObject->getProperties() as $property)
        {
            $property->setAccessible(true);
            $propertyName = $property->getName();
            $properties[$propertyName] = $property->getValue($classMapInstance);
        }

        $attributes = array_filter($properties, function ($key) {
            return  $key != 'id';
        }, ARRAY_FILTER_USE_KEY);

        if(! \array_key_exists('id', $properties))
        {
            throw new Exception(
                'Must to define (id) for entity ('. get_class($classMapInstance)
            );
        }

        return [$id = $properties['id'], $attributes];
    }
}