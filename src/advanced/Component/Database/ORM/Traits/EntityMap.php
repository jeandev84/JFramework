<?php
namespace Jan\Component\Database\ORM\Traits;


use ReflectionObject;

/**
 * Trait EntityMap
 * @package Jan\Component\Database\ORM\Traits
*/
trait EntityMap
{

    /**
     * Map entity properties
     *
     * @param object $instance
     * @return array
    */
    public function properties(object $instance)
    {
        $reflectedObject = new ReflectionObject($instance);
        $properties = [];

        foreach($reflectedObject->getProperties() as $property)
        {
            $property->setAccessible(true);
            $propertyName = $property->getName();
            $properties[$propertyName] = $property->getValue($instance);
        }

        return $properties;
    }

}