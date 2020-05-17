<?php
namespace Jan\Component\Database\ORM;


use Exception;
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

        return [$properties['id'], $attributes];
    }


     /**
      * @param object $classMapInstance
     */
     public function persist(object $classMapInstance)
     {
          $this->registerRecord('PERSIST', $classMapInstance);
     }


     /**
      * @param object $classMapInstance
     */
     public function delete(object $classMapInstance)
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
                        list($id, $attributes) = $this->mapClassProperties($classMapInstance);

                        if($recordType === 'PERSIST')
                        {
                             $this->store($attributes, $id);
                        }

                        if($recordType === 'DELETE')
                        {
                            $this->remove($id);
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
     * Insert data to the database
     *
     * @param array $attributes
     * @return int
     */
    public function insert(array $attributes)
    {
        $sql = sprintf('INSERT INTO `%s`(%s) VALUES (%s)',
            $this->table,
            $this->formatInsertFields($attributes),
            $this->formatInsertBinds($attributes)
        );

        $this->manager->execute($sql, array_values($attributes));
        return $this->manager->lastId();
    }


    /**
     * Update data to the database
     *
     * @param array $attributes
     * @param int $id
     * @return mixed
    */
    public function update(array $attributes, int $id)
    {
        $sql = sprintf('UPDATE %s SET %s WHERE id = ?',
            $this->table,
            $this->assignColumn($attributes)
        );

        $values = array_merge(array_values($attributes), compact('id'));
        $this->manager->execute($sql, $values);
    }


    /**
     * @param array $attributes
     * @param int $id
    */
    public function store(array $attributes, int $id)
    {
        if(is_null($id))
        {
            $this->insert($attributes);
        }else{
            $this->update($attributes, $id);
        }
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
     *
     * @param int $id
     * @return mixed
    */
    public function remove(int $id)
    {
        $sql = 'DELETE FROM '. $this->table .' WHERE id = :id';

        if($this->isSoftDeleted())
        {
            // $sql = 'UPDATE '. $this->table .' SET deleted_at = 1 WHERE id = :id';
            return $this->update(['deleted_at' => 1], $id);
        }

        return $this->manager->execute($sql, compact('id'));
    }


    /**
     * @param int $id
     * @return mixed
     */
    public function restore(int $id)
    {
        if($this->isSoftDeleted())
        {
            // $sql = 'UPDATE '. $this->table.' SET deleted_at = 0 WHERE id = :id';
            $attributes = ['deleted_at' => 0];
            return $this->update($attributes, $id);
        }
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
     * @param object $classMapInstance
    */
    protected function registerRecord(string $recordType, object $classMapInstance)
    {
          $this->records[$recordType][] = $classMapInstance;
          $this->table = $classMapInstance->getTable();
    }


    /**
     * @param $properties
     * @param $item
     * @return bool
    */
    private function getProperty($properties, $item)
    {
        return $properties[$item] ?? null;
    }
}