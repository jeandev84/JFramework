<?php
namespace Jan\Component\Database\ORM;


use Exception;

/**
 * Class AbstractEntity
 * @package Jan\Component\Database\ORM
*/
abstract class AbstractEntity /* implements \ArrayAccess */
{

    use Generator;


    /** @var string */
    protected $table;


    /**
     * Get table name
     * @return string
     * @throws \ReflectionException
    */
    public function getTable()
    {
       if(! $this->table)
       {
           return $this->generateTableNameOfEntity(static::class);
       }

       return $this->table;
    }

    
    /*
    public function getAttributes() {}
    public function getFillable() {}
    public function getGuard() {}
    public function getHidden() {}
    */
    

    /**
     * @param object $classMapInstance
     * @return mixed
     * @throws Exception
    */
    /*
    public function mapClassProperties(object $classMapInstance)
    {
        $reflectedObject = new \ReflectionObject($classMapInstance);
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
    */


    /**
     * @param $classMapInstance
     * @throws \ReflectionException
    */
    /*
    public function mapEntityTableName($classMapInstance)
    {
        $this->table = $this->generateTableNameOfEntity($classMapInstance);

        if($classMapInstance instanceof AbstractEntity)
        {
            $this->table = $classMapInstance->getTable();
        }
    }
    */
}