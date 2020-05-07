<?php
namespace Jan\Component\Database\ORM;


use Jan\Component\Database\Contracts\EntityManagerInterface;
use Jan\Component\Database\Contracts\QueryManagerInterface;


/**
 * Class EntityManager
 * @package Jan\Component\Database\ORM
*/
class EntityManager implements EntityManagerInterface
{
    

    /** @var object */
    protected $entityObject;


    /** @var QueryManagerInterface  */
    protected $manager;


    /** @var array */
    protected $properties = [];

    
    /** @var  */
    protected $recordType = false;
    
    
    /**
     * EntityManager constructor.
     * @param QueryManagerInterface $manager
    */
    public function __construct(QueryManagerInterface $manager)
    {
         $this->manager = $manager;
    }



    /**
     * @param object $entityObject
     * @return array
    */
    public function mapClassProperties(object $entityObject)
    {
        $reflectedObject = new \ReflectionObject($entityObject);
        $properties = [];

        foreach($reflectedObject->getProperties() as $property)
        {
            $property->setAccessible(true);
            $propertyName = $property->getName();
            $properties[$propertyName] = $property->getValue($entityObject);
        }

        return $properties;
    }
    

    /**
     * @param object $entityObject
    */
    public function persist(object $entityObject)
    {
        $this->initialise($entityObject, 'PERSIST');
    }


    /**
     * @param object $entityObject
    */
    public function delete(object $entityObject)
    {
        $this->initialise($entityObject, 'DELETE');
    }
    
    
    /**
     * Save to the database
    */
    public function flush()
    {
         // save to the database
         // dump($this->properties, $this->entityObject);
         if($this->hasId())
         {
             if($this->hasPersist())
             {
                 echo 'Insert';
                 $this->insert();

             } else{

                 echo 'Update';
                 $this->update();
             }
             
             if($this->hasDelete())
             {
                  $this->remove();
             }

         } else{

             throw new \Exception('id property is not setted!');
         }
    }


    /**
     * Insert data to the database
    */
    protected function insert()
    {
        // dump($this->properties);
        $columns = array_keys($this->properties);

        $fields = '`'. implode('`, `', $columns) . '`';
        $binds = implode(', ', array_fill(0, count($columns), '?'));

        /*
        $sql = 'INSERT INTO `' . $this->entityObject->tableName() .'`';
        $sql .= '('. $fields .')';
        $sql .= ' VALUES('. $binds .')';
        */

        $sql = sprintf('INSERT INTO `%s`(%s) VALUES (%s)',
            $this->entityObject->tableName(),
            $fields,
            $binds
        );

        $this->manager->execute($sql, array_values($this->properties));
    }



    /**
     * Update data to the database
    */
    protected function update()
    {
        dump($this->properties);
    }


    /**
     * Remove object from database
    */
    protected function remove()
    {
        $sql = 'DELETE FROM '. $this->entityObject->tableName() .' WHERE id = :id';
        return $this->manager->execute($sql, ['id' => $this->getObjectId()]);
    }
    
    
    /**
     * Determine if has new record
     * @return bool
     */
    protected function isNewRecord()
    {
        return is_null($this->properties['id']);
    }

    /**
     * @return bool
    */
    protected function hasId()
    {
        return array_key_exists('id', $this->properties);
    }


    /**
     * @return mixed
    */
    private function getObjectId()
    {
         if($this->hasId())
         {
             return $this->properties['id'];
         }
    }
    
    /**
     * @return bool
    */
    protected function hasPersist()
    {
        return $this->isNewRecord() && $this->recordType === 'PERSIST';
    }

    
    /**
     * @return bool
    */
    protected function hasDelete()
    {
        return $this->recordType === 'DELETE';
    }

    /**
     * @param object $entityObject
     * @param string $recordType 
   */
    protected function initialise(object $entityObject, string $recordType)
    {
        $this->properties = $this->mapClassProperties($entityObject);
        $this->recordType = $recordType;
        $this->entityObject = $entityObject;
    }
}