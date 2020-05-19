<?php
namespace Jan\Component\Database\Connectors\PDO;


use Exception;
use Jan\Component\Database\Contracts\ManagerInterface;
use Jan\Component\Database\Exceptions\StatementException;
use PDO;
use PDOException;
use PDOStatement;



/**
 * Class QueryManager
 * @package Jan\Component\Database
 *
 * Execute query
*/
class Query implements ManagerInterface
{

    /** @var PDO  */
    protected $connection;


    /** @var array  */
    protected $records = [];


    /** @var PDOStatement */
    protected $statement;


    /** @var string */
    protected $classMap;


    /**
      * Query constructor.
      *
      * @param PDO $connection
      * @param string|null $classMap
     */
     public function __construct(PDO $connection, string $classMap = null)
     {
          $this->connection = $connection;
          $this->classMap($classMap);
     }


     /**
      * Entity class to map
      * @param string|null $classMap
      * @return Query
     */
     public function classMap(?string $classMap)
     {
         $this->classMap = $classMap;

         return $this;
     }


     /**
      * @return PDO
     */
     public function getConnection()
     {
         return $this->connection;
     }


    /**
     * @param string $sql
     * @param array $params
     * @param bool $statement
     * @return Query|PDOStatement
     */
     public function execute(string $sql, array $params = [], $statement = false)
     {
         try {

             $this->statement = $this->connection->prepare($sql);

             if($this->statement->execute($params))
             {
                 $this->records['execute'][] = compact('sql', 'params');
             }

         } catch (PDOException $e) {

             throw $e;
         }

         if(! $statement)
         {
             return $this;
         }

         return $this->statement;
     }


     /**
      * @param $sql
      * @return void
     */
     public function exec($sql)
     {
        try {

            if($this->connection->exec($sql))
            {
                $this->records['exec'][] = compact('sql');
            }

        } catch (PDOException $e) {
            throw $e;
        }
     }


    /**
     * @param int $fetchStyle
     * @return array
     * @throws StatementException
    */
    public function fetchAll($fetchStyle = PDO::FETCH_OBJ)
    {
        if($this->classMap)
        {
            return $this->getStatement()->fetchAll(PDO::FETCH_CLASS, $this->classMap);
        }

        return $this->getStatement()->fetchAll($fetchStyle);
    }


    /**
     * @param int $fetchStyle
     * @return array|mixed
     * @throws StatementException
    */
    public function fetchOne($fetchStyle = PDO::FETCH_OBJ)
    {
        return $this->fetchAll($fetchStyle)[0] ?? [];
    }


    /**
     * Begin transaction
    */
    public function beginTransaction()
    {
        $this->connection->beginTransaction();
    }


    /**
     * Commit
    */
    public function commit()
    {
        $this->connection->commit();
    }


    /**
     * Rollback
    */
    public function rollback()
    {
        $this->connection->rollBack();
    }


    /**
     * @param callable $callback
    */
    public function transaction(callable $callback)
    {
        try {

            $this->beginTransaction();
            call_user_func($callback, $this);
            $this->commit();

        } catch (PDOException $e) {

            $this->rollBack();
            throw $e;
        }
    }


    /**
     * Get row count
     *
     * @return int
     * @throws Exception
    */
    public function count()
    {
        return $this->getStatement()->rowCount();
    }


    /**
     * Get last insert id
     *
     * @return int
    */
    public function lastId()
    {
        return $this->connection->lastInsertId();
    }


    /**
     * Close current cursor
     * @throws StatementException
    */
    public function closeCursor()
    {
        $this->getStatement()->closeCursor();
    }


    /**
     * @return array
    */
    public function records()
    {
        return $this->records;
    }

    

    /**
     * Get statement
     *
     * @return PDOStatement
     * @throws StatementException
    */
    private function getStatement()
    {
        if(! $this->statement instanceof PDOStatement)
        {
            throw new StatementException(
                'Can not executed because there are not statement yet executed!'
            );
        }

        return $this->statement;
    }


    /**
     * Destructor
    */
    public function __destruct()
    {
        /* $this->closeCursor(); */
    }
}

