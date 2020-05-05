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
     * @param string $sql
     * @param array $params
     * @return mixed
     */
    public function query($sql, $params = [])
    {
        return $this->manager->execute($sql, $params);
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
     * Find all
     */
    public function findAll()
    {
        $result = $this->manager->addSql('SELECT * FROM '. $this->tableName())
            ->executeQuery()
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

        $result = $this->manager->addSql($sql)
            ->addValues($criteria)
            ->executeQuery()
            ->getResults();

        return $result ?? [];
    }


    /* public function find($id, $lockMode = null, $lockVersion = null) {} */


    public function findOneBy(array $criteria, array $oderBy = null)
    {
        //
    }

    public function findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
    {
        //
    }

    public function findOne()
    {
        //
    }


    /**
     * @param array $properties
     */
    protected function update(array $properties)
    {

    }


    /**
     * @param array $properties
     */
    protected function insert(array $properties)
    {

    }


    /**
     * Save data to the database
     */
    public function save()
    {

    }


    /**
     * @param object $object
     */
    public function persist(object $object)
    {

    }

    public function flush()
    {

    }
}