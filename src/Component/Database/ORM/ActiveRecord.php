<?php
namespace Jan\Component\Database\ORM;


use Exception;
use Jan\Component\Database\Contracts\QueryManagerInterface;
use Jan\Component\Database\Statement;
use PDO;



/**
 * Abstract class ActiveRecord
 * @package Jan\Component\Database\ORM
*/
abstract class ActiveRecord
{

    /** @var string */
    protected $table;


    /** @var QueryManagerInterface */
    protected $manager;


    /** @var string  */
    protected $entityClass;


    /** @var bool  */
    protected $softDelete = true;


    /** @var \DateTime */
    protected $deletedAt;


    /**
     * EntityRepository constructor.
     * @param QueryManagerInterface $manager
     * @param string $entityClass
     */
    public function __construct(QueryManagerInterface $manager, string $entityClass)
    {
        $this->manager = $manager;
        $this->entityClass = $entityClass;
    }


    /**
     * @param \PDOStatement $stmt
     * @param int $fetchStyle
     * @return array
    */
    protected function getRecords(\PDOStatement $stmt, $fetchStyle = PDO::FETCH_OBJ)
    {
        if($this->entityClass)
        {
            return $stmt->fetchAll(PDO::FETCH_CLASS, $this->entityClass);
        }

        return $stmt->fetchAll($fetchStyle);
    }


    /**
     * @param \PDOStatement $stmt
     * @param int $fetchStyle
     * @return array|mixed
    */
    protected function getFirstRecord(\PDOStatement $stmt, $fetchStyle = PDO::FETCH_OBJ)
    {
          return $this->getRecords($stmt, $fetchStyle)[0] ?? [];
    }



    /**
     * Find all
    */
    public function findAll()
    {
        $sql = $this->getConcreteSql('SELECT * FROM '. $this->tableName());
        $results = $this->getRecords($this->manager->execute($sql));

        return $results ?? [];
    }


    /**
     * @param array $criteria
     * @return mixed
     * @throws \ReflectionException
     */
    public function find(array $criteria)
    {
        $sql = 'SELECT * FROM '. $this->tableName() .' WHERE '; // WHERE

        // AND WHERE
        foreach ($criteria as $column => $value)
        {
            $sql .= $column .' = :'. $column;
            if(next($criteria))
            {
                $sql .= ' AND ';
            }
        }

        $sql = $this->getConcreteSql($sql, false);
        $result = $this->getRecords($this->manager->execute($sql, $criteria));

        return $result ?? [];
    }


    /**
     * @param array $criteria
    */
    public function findOne(array $criteria)
    {
         //
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
            $sql = 'UPDATE '. $this->tableName() .' SET deleted_at = 1 WHERE id = :id';
        }

        return $this->manager->execute($sql, ['id' => $id]); // compact('id')
    }


    /**
     * @param int $id
     * @return mixed
     * @throws \ReflectionException
    */
    public function restore(int $id)
    {
        if($this->isSoftDeleted())
        {
            // deleted_at (datetime may be)
            $sql = 'UPDATE '. $this->tableName() .' SET deleted_at = 0 WHERE id = :id';
            return $this->manager->execute($sql, ['id' => $id]); // compact('id')
        }
    }



    /**
     * @return int
    */
    protected function isSoftDeleted()
    {
        return $this->softDelete === true
               || property_exists($this, 'deletedAt');
        // \in_array('deleted_at', $mappedProperties)
    }


    /**
     * @param array $propertiesFromDb
     * @return string
    */
    protected function update(array $propertiesFromDb)
    {
          return 'Updated!';
    }


    /**
     * @param array $propertiesFromDb
     * @return string
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


    /**
     * @param string $sql
     * @param bool $where
     * @return string
     */
    protected function getConcreteSql(string $sql, $where = true)
    {
        if($this->isSoftDeleted())
        {
            // $sql .= ' AND WHERE deleted_at != false'; // WHERE
            $sql .= ($where ? ' WHERE ' : ' AND ') .' deleted_at = 0'; // WHERE
        }

        return $sql;
    }

    /** Get name of table string */
    abstract protected function tableName();
}