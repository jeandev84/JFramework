<?php
namespace Jan\Component\Database\ORM;


use Exception;
use Jan\Component\Database\Contracts\EntityInterface;
use Jan\Component\Database\Contracts\EntityManagerInterface;
use Jan\Component\Database\Contracts\EntityRepositoryInterface;
use Jan\Component\Database\Contracts\QueryInterface;
use Jan\Component\Database\ORM\Traits\SoftDeletes;
use ReflectionObject;



/**
 * Class EntityManager
 * @package Jan\Component\Database\ORM
*/
class EntityManager
{


     use Generator, SoftDeletes;


     const TYPE_PERSIST = 'PERSIST';
     const TYPE_DELETE  = 'DELETE';


     /** @var QueryInterface  */
     protected $manager;


     /** @var array  */
     protected $attributes = [];


     /** @var array  */
     protected $objectStorage = [];



     /** @var object */
     protected $classMapInstance;


     /** @var string */
     protected $recordType;


     /** @var string */
     protected $table;


     /**
      * EntityManager constructor.
      * @param QueryInterface $manager
     */
     public function __construct(QueryInterface $manager)
     {
          $this->manager = $manager;
     }


    /**
     * @param $table
     * @return EntityManager
    */
    public function setTable($table)
    {
        $this->table = $table;

        return $this;
    }


    /**
     * @return QueryInterface
     *
     * $lastId = $this->getQuery()->lastId();
    */
    public function getQuery()
    {
        return $this->manager;
    }


     /**
      * @param object $classMapInstance
      * @return mixed
      * @throws Exception
     */
     public function registerClassMapProperties(object $classMapInstance = null)
     {
            $classMapInstance = $classMapInstance ?? $this->classMapInstance;
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


     /**
      * @param object $classMapInstance
     */
     public function persist(object $classMapInstance)
     {
          $this->registerClassMap(self::TYPE_PERSIST, $classMapInstance);
     }


     /**
      * @param object $classMapInstance
     */
     public function delete(object $classMapInstance)
     {
         $this->registerClassMap(self::TYPE_DELETE, $classMapInstance);
     }


     /**
      * Save changes to database
      * @throws Exception
     */
     public function flush()
     {
         try {

             $this->manager->beginTransaction();
             $this->recordProcess();
             $this->manager->commit();

         } catch (Exception $e) {

             $this->manager->rollback();
             throw $e;
         }
     }




    /**
     * @param string $recordType
     * @param object $classMapInstance
    */
    protected function registerClassMap(string $recordType, object $classMapInstance)
    {
        $this->objectStorage[$this->recordType = $recordType][] = $classMapInstance;
    }


    /**
     * @throws Exception
    */
    protected function recordProcess()
    {
         if(isset($this->objectStorage[$this->recordType]))
         {
             $classMapInstances = $this->objectStorage[$this->recordType];
    
             foreach ($classMapInstances as $classMapInstance)
             {
                 list($id, $attributes) = $this->registerClassMapProperties($classMapInstance);
                 $this->mapEntityTableName($classMapInstance);

                 if($this->isPersist())
                 {
                     if(is_null($id))
                     {
                         $this->insert($attributes);
                     }else{
                         $this->update($attributes, $id);
                     }
                 }

                 if($this->isDelete())
                 {
                     $this->remove($id);
                 }
             }
         }
     }


    /**
     * Insert data to the database
     *
     * @param array $attributes
     * @return void
     */
    public function insert(array $attributes)
    {
        $sql = sprintf('INSERT INTO `%s`(%s) VALUES (%s)',
            $this->getTableName(),
            $this->formatInsertFields($attributes),
            $this->formatInsertBinds($attributes)
        );

        return $this->manager->execute($sql, array_values($attributes));
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
            $this->getTableName(),
            $this->assignColumn($attributes)
        );

        $values = array_merge(array_values($attributes), [$id]);
        return $this->manager->execute($sql, $values);
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
     * @throws \ReflectionException
     */
    public function remove(int $id)
    {
        $sql = 'DELETE FROM '. $this->getTableName() .' WHERE id = :id';

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
     *
     * TODO replace argument (int id) by (object) and $id = $object->getId();
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
     * @return string
     */
    protected function getTableName()
    {
       return $this->table;
    }


    /**
     * @return bool
    */
    private function isPersist()
    {
        return $this->recordType === self::TYPE_PERSIST;
    }


    /**
     * @return bool
    */
    private function isDelete()
    {
        return $this->recordType === self::TYPE_DELETE;
    }


    /**
     * @param $classMapInstance
     * @throws \ReflectionException
    */
    public function mapEntityTableName($classMapInstance)
    {
        $this->table = $this->generateTableNameOfEntity($classMapInstance);

        if($classMapInstance instanceof ModelRepository)
        {
            $this->table = $classMapInstance->getTable();
        }
    }
}

/* 
dump($properties);
dd(array_filter($properties));
^ array:7 [▼
  "id" => null
  "name" => "user1"
  "password" => "$2y$10$Zeh5TEt/Tm5fMAKDmRSSwe4Hs7BXSs.mk4jWf1p5Bxcky3jDqdtrm"
  "email" => "user1@gmail.com"
  "address" => "Kurgan, ulitsa volodarskovo dom 1"
  "role" => "user"
  "deleted_at" => 0
]
^ array:5 [▼
  "name" => "user1"
  "password" => "$2y$10$Zeh5TEt/Tm5fMAKDmRSSwe4Hs7BXSs.mk4jWf1p5Bxcky3jDqdtrm"
  "email" => "user1@gmail.com"
  "address" => "Kurgan, ulitsa volodarskovo dom 1"
  "role" => "user"
]
*/