<?php
namespace Jan\Component\Database\ORM;


use Jan\Component\Database\Contracts\EntityInterface;
use Jan\Component\Database\Contracts\EntityManagerInterface;
use Jan\Component\Database\Contracts\EntityRepositoryInterface;
use Jan\Component\Database\Contracts\ManagerInterface;
use Jan\Component\Database\Exceptions\ConnectionException;
use Jan\Component\Database\ORM\Traits\SoftDeletes;
use ReflectionClass;
use ReflectionException;


/**
 * Class EntityRepository
 * @package Jan\Component\Database\ORM
*/
class EntityRepository implements EntityRepositoryInterface
{

      use Generator, SoftDeletes;


      /** @var ManagerInterface */
      protected $manager;


      /** @var  string */
      protected $entityClass;


      /** @var EntityManagerInterface */
      protected $entityManager;


      /** @var string */
      private $table;


     /**
      * EntityRepository constructor.
      * @param ManagerInterface $manager
      * @param string|null $entityClass
      * @throws ReflectionException
     */
      public function __construct(ManagerInterface $manager, $entityClass = null)
      {
          $this->manager = $manager;
          $this->manager->classMap($entityClass);
          $this->table = $this->generateTableNameOfEntity($entityClass);
      }



      /**
       * @param null $alias
       * @return QueryBuilder
       * @throws ReflectionException
      */
      public function createQueryBuilder($alias = null)
      {
          $queryBuilder = new QueryBuilder();
          $queryBuilder->select()->from($this->getTable(), $alias);
          return $queryBuilder;
      }


      /**
       * @return mixed
      */
      public function getConnection()
      {
         return $this->manager->getConnection();
      }


    /**
     * @param string $condition
     * @param $value
     * @return string
     * @throws ReflectionException
    */
    public function where(string $condition, $value)
    {
        $sql = 'SELECT * FROM '. $this->getTable() .' WHERE '. $condition;
        return $this->manager->execute($sql, [$value]);
    }


    /**
      * Find all
      * @throws ReflectionException
    */
    public function findAll()
    {
         $sql = $this->resolveSql('SELECT * FROM '. $this->getTable());
         return $this->manager->execute($sql)->get();
    }



    /**
     * @param array $criteria
     * @return mixed
     * @throws ReflectionException
    */
    public function find(array $criteria)
    {
        $sql = 'SELECT * FROM '. $this->getTable() .' WHERE ';

        // AND WHERE
        foreach ($criteria as $column => $value)
        {
            $sql .= $column .' = :'. $column;
            if(next($criteria))
            {
                $sql .= ' AND ';
            }
        }

        $sql = $this->resolveSql($sql, false);
        return $this->manager->execute($sql, $criteria)->get();
    }


    /**
     * @param array $criteria
     * @return mixed
    */
    public function findBy(array $criteria)
    {
        //
    }



    /**
     * @param int $id
     * @return mixed
     */
    public function findOne(int $id)
    {
        //
    }



    /**
     * @param array $criteria
     * @return mixed
     */
    public function findOneBy(array $criteria)
    {
        //
    }



    /**
      * Add end sql if has soft deleting
      *
      * @param string $sql
      * @param bool $where
      * @return string
    */
    protected function resolveSql(string $sql, $where = true)
    {
        if($this->isSoftDeleted())
        {
            $sql .= ($where ? ' WHERE ' : ' AND ') .'deleted_at = 0 OR NULL';
        }

        return $sql;
    }



    /**
      * @return string
      * @throws ReflectionException
    */
    public function getTable()
    {
        return $this->table;
    }
}