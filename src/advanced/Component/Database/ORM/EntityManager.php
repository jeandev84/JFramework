<?php
namespace Jan\Component\Database\ORM;


use Exception;
use Jan\Component\Database\Contracts\EntityInterface;
use Jan\Component\Database\Contracts\ManagerInterface;
use Jan\Component\Database\ORM\Traits\SoftDeletes;
use ReflectionObject;

/**
 * Class EntityManager
 * @package Jan\Component\Database\ORM
*/
class EntityManager
{


     use SoftDeletes;


     /** @var ManagerInterface  */
     protected $manager;


     /** @var array  */
     protected $attributes = [];


     /** @var array  */
     protected $records = [];


     /** @var string */
     protected $table;


     /**
      * EntityManager constructor.
      * @param ManagerInterface $manager
     */
     public function __construct(ManagerInterface $manager)
     {
          $this->manager = $manager;
     }


     /**
      * @param EntityInterface $classMapInstance
     */
     public function persist(EntityInterface $classMapInstance)
     {
          $this->registerRecord('PERSIST', $classMapInstance);
     }


     /**
      * @param EntityInterface $classMapInstance
     */
     public function delete(EntityInterface $classMapInstance)
     {
         $this->registerRecord('DELETE', $classMapInstance);
     }


     /**
      * Save changes to database
      * @throws Exception
     */
     public function flush()
     {
         try {

             $this->manager->beginTransaction();

             foreach($this->records as $recordType => $classMapInstances)
             {
                   foreach($classMapInstances as $classMapInstance)
                   {
                        $properties = $this->mapClassProperties($classMapInstance);

                        if($recordType === 'PERSIST')
                        {
                             if($this->isNewRecord($properties))
                             {
                                 $this->insert($properties);
                             }else{
                                 $this->update($properties);
                             }
                        }

                        if($recordType === 'DELETE')
                        {
                            $this->remove($properties);
                        }
                   }
             }

             $this->manager->commit();

         } catch (Exception $e) {

             $this->manager->rollback();
             throw $e;
         }
     }


    /**
     * @param object $classMapInstance
     * @return mixed
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

        return $properties;
    }


    /**
     * Insert data to the database
     *
     * @param array $properties
     * @return int
     */
    protected function insert(array $properties)
    {
        $sql = sprintf('INSERT INTO `%s`(%s) VALUES (%s)',
            $this->table,
            $this->formatInsertFields($properties),
            $this->formatInsertBinds($properties)
        );

        $this->manager->execute($sql, array_values($properties));
        return $this->manager->lastId();
    }


    /**
     * Update data to the database
     *
     * @param array $properties
     * @return void
     */
    protected function update(array $properties)
    {
        $sql = sprintf('UPDATE %s SET %s WHERE id = ?',
            $this->table,
            $this->assignColumn($properties)
        );

        $values = array_merge(array_values($properties), (array) $properties['id']);
        $this->manager->execute($sql, $values);
    }


    /**
     * @param array $properties
     * @return string
     */
    protected function assignColumn(array $properties)
    {
        $affected = [];
        foreach (array_keys($properties) as $column)
        {
            array_push($affected, sprintf(' `%s` = ?', $column));
        }

        return join(',', $affected);
    }


    /**
     * Remove object from database
     * @param array $properties
     * @return mixed
     */
    protected function remove(array $properties)
    {
        $sql = 'DELETE FROM '. $this->table .' WHERE id = :id';
        return $this->manager->execute($sql, ['id' => $properties['id']]);
    }



    /**
     * @param array $properties
     * @return string
     */
    protected function formatInsertFields(array $properties)
    {
        return '`'. implode('`, `', array_keys($properties)) . '`';
    }


    /**
     * @param array $properties
     * @return string
    */
    protected function formatInsertBinds(array $properties)
    {
        $columns = array_keys($properties);
        return implode(', ', array_fill(0, count($columns), '?'));
    }


    /**
     * @param string $recordType
     * @param EntityInterface $classMapInstance
    */
    protected function registerRecord(string $recordType, EntityInterface $classMapInstance)
    {
          $this->records[$recordType][] = $classMapInstance;
          $this->table = $classMapInstance->getTable();
    }


    /**
     * @param array $properties
     * @return int
     * @throws Exception
    */
    protected function isNewRecord(array $properties)
    {
        if(! \array_key_exists('id', $properties))
        {
            throw new Exception('Property (id) is required for saving data');
        }

        return is_null($properties['id']);
    }

}