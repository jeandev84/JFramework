<?php
namespace Jan\Component\Database\ORM;


use Jan\Component\Database\Contracts\EntityManagerInterface;
use Jan\Component\Database\Contracts\QueryManagerInterface;
use Jan\Component\Database\Statement;


/**
 * Class EntityManager
 * @package Jan\Component\Database\ORM
 *
 * TODO Refactoring this class
 * Restructure all
*/
class EntityManager implements EntityManagerInterface
{

    /** @var array  */
    protected $objectRegistries = [];


    /** @var QueryManagerInterface  */
    protected $manager;


    /** @var int */
    protected $lastId;


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
     * @param array $attributes
     * [ $attributes used For example if we want to definie our properties ]
     *
     * @return array
    */
    public function mapClassProperties(object $entityObject, array $attributes = [])
    {
        if($attributes)
        {
            return $attributes;
        }

        return $this->resolveObjectProperties($entityObject);
    }


    /**
     * @param object $entityObject
     * @return array
    */
    public function resolveObjectProperties(object $entityObject)
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
        $this->collectByRecordType($entityObject, 'PERSIST');
    }


    /**
     * @param object $entityObject
    */
    public function delete(object $entityObject)
    {
        $this->collectByRecordType($entityObject, 'DELETE');
    }



    /**
     * @param $properties
     * @return
     * @throws \Exception
    */
    protected function getId($properties)
    {
        if(! \array_key_exists('id', $properties))
        {
            throw new \Exception('Property (id) is required for flushing data');
        }

        return $properties['id'];
    }

    /**
     * Save to the database
     * @throws \Exception
     */
    public function flush()
    {
       // Begin transaction
       try {

            $this->manager->getConnection()->beginTransaction();

            foreach ($this->objectRegistries as $record => $objects)
            {
                foreach ($objects as $object)
                {
                    $properties = $this->mapClassProperties($object);

                    if($record === 'PERSIST')
                    {
                        if(! is_null($this->getId($properties)))
                        {
                            $this->update($object, $properties);
                        } else {
                            $this->insert($object, $properties);
                        }
                    }

                    if($record === 'DELETE')
                    {
                        $this->remove($object, $properties);
                    }
                }
            }

            $this->manager->getConnection()->commit();

        } catch (\Exception $e) {

            $this->manager->getConnection()->rollback();
            throw $e;
        }

    }


    /**
     * Insert data to the database
     *
     * Retourne last insertId
     * @param object $entityObject
     * @param array $properties
     * @return
     */
    protected function insert(object $entityObject, array $properties)
    {
        $sql = sprintf('INSERT INTO `%s`(%s) VALUES (%s)',
            $entityObject->tableName(),
            $this->formatInsertFields($properties),
            $this->formatInsertBinds($properties)
        );

        $this->manager->execute($sql, array_values($properties));
        return $this->lastId = $this->manager->getConnection()->lastInsertId();
    }


    /**
     * Update data to the database
     *
     * @param object $entityObject
     * @param array $properties
     * @return void
     */
    private function update(object $entityObject, array $properties)
    {
        $sql = sprintf('UPDATE %s SET %s WHERE id = ?',
          $entityObject->tableName(),
          $this->assignColumn($properties)
        );

        $values = array_merge(array_values($properties), (array) $properties['id']);
        $this->manager->execute($sql, $values);
    }


    /**
     * @param array $properties
     * @return string
     */
    private function assignColumn(array $properties)
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
     * @param object $entityObject
     * @param array $properties
     * @return mixed
    */
    private function remove(object $entityObject, array $properties)
    {
        $sql = 'DELETE FROM '. $entityObject->tableName() .' WHERE id = :id';
        return $this->manager->execute($sql, ['id' => $properties['id']]);
    }


    /**
     * @param object $entityObject
     * @param string $recordType 
   */
    protected function collectByRecordType(object $entityObject, string $recordType)
    {
        $this->objectRegistries[$recordType][] = $entityObject;
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
}