<?php
namespace Jan\Component\Database\ORM;


use Jan\Component\Database\Contracts\QueryManagerInterface;
use Jan\Component\Database\Statement;
use PDO;



/**
 * Abstract class ActiveRecord
 * @package Jan\Component\Database\ORM
*/
abstract class ActiveRecord
{

    /** @var Statement */
    protected $statement;


    /** @var string */
    protected $table;


    /** @var QueryManagerInterface */
    protected $manager;


    /** @var string  */
    protected $entity;


    /** @var bool  */
    protected $softDelete = false;


    /** @var \DateTime */
    protected $deletedAt;


    /**
     * EntityRepository constructor.
     * @param QueryManagerInterface $manager
     * @param string $entity
     */
    public function __construct(QueryManagerInterface $manager, string $entity)
    {
        $this->manager = $manager;
        $this->manager->registerClassMap($entity);
        $this->entity = $entity;
    }


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


    /**
     * @return QueryManagerInterface
     *
     * from manager can get connection via method
     * $this->getManager()->getConnection() ...
     */
    public function getManager()
    {
        return $this->manager;
    }


    /**
     * @param string $sql
     * @param array $params
     * @return mixed
    */
    public function query($sql, $params = [])
    {
        return $this->manager->execute($sql, $params);
    }


    /**
     * Find all
    */
    public function findAll()
    {
        $sql = 'SELECT * FROM '. $this->tableName();

        if($this->isSoftDeleted())
        {
            $sql .= ' WHERE deleted_at != false'; // WHERE deleted_at = true
        }

        $result = $this->manager->execute($sql)
                                ->getResults();


        return $result ?? [];
    }


    /**
     * @param array $criteria
     * @return mixed
     * @throws \ReflectionException
     */
    public function find(array $criteria)
    {
        $sql = 'SELECT * FROM '. $this->tableName() .' WHERE ';
        foreach ($criteria as $column => $value)
        {
            $sql .= $column .' = :'. $column;
            if(next($criteria))
            {
                $sql .= ' AND ';
            }
        }

        if($this->isSoftDeleted())
        {
            $sql .= ' AND WHERE deleted_at != false'; // WHERE
        }

        $result = $this->manager->execute($sql, $criteria)
                                ->getResults();

        return $result ?? [];
    }


    /**
     * Save data to the database
    */
    public function save()
    {
        $mappedProperties = [];
        if(! $this->isNewRecord())
        {
            return $this->update($mappedProperties);
        }else{
            return $this->insert($mappedProperties);
        }
    }



    /**
     * @param int $id
     * @return
     * @throws \ReflectionException
    */
    public function delete(int $id)
    {
        $sql = 'DELETE FROM '. $this->tableName() .' WHERE id = :id';

        if($this->isSoftDeleted())
        {
            // deleted_at (datetime may be)
            $sql = 'UPDATE '. $this->tableName() .' SET deleted_at = true WHERE id = :id';
        }

        return $this->manager->exec($sql);
    }

    /**
     * @return int
    */
    protected function isSoftDeleted()
    {
        return $this->softDelete === true & property_exists($this, 'deletedAt');
    }


    /**
     * @param array $propertiesFromDb
     */
    protected function update(array $propertiesFromDb)
    {
          return 'Updated!';
    }


    /**
     * @param array $propertiesFromDb
    */
    protected function insert(array $propertiesFromDb)
    {
         return 'Inserted!';
    }


    /**
     * Determine if has new record
     * @return bool
    */
    protected function isNewRecord()
    {
       return property_exists($this, 'id') && is_null($this->id);
    }
}