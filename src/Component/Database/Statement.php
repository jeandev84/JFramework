<?php
namespace Jan\Component\Database;


use Exception;
use Jan\Component\Database\Contracts\QueryManagerInterface;
use Jan\Component\Database\Exceptions\StatementException;
use PDO;
use PDOException;
use PDOStatement;


/**
 * Class Statement
 * @package Jan\Component\Database
 *
 * Execute query
*/
class Statement implements QueryManagerInterface
{

    /** @var PDO  */
    protected $connection;


    /** @var PDOStatement */
    protected $stmt;


    /** @var string|null  */
    protected $classMap;



    /** @var array  */
    protected $executedSql = [];


     /**
      * Query constructor.
      *
      * @param PDO $connection
     */
     public function __construct(PDO $connection)
     {
         $this->addConnection($connection);
     }

     /**
      * @param string $entity
      * @return Statement
     */
     public function registerClassMap(string $entity)
     {
         $this->classMap = $entity;

         return $this;
     }

     /**
      * @param $sql
      * @param array $params
      * @return Statement
     */
     public function execute(string $sql, array $params = [])
     {
         try {

             $this->stmt = $this->connection->prepare($sql);

             if($this->stmt->execute($params))
             {
                 $this->executedSql[] = compact('sql', 'params');
             }

         } catch (PDOException $e) {

             die($e->getMessage());
         }

         return $this;
     }


     /**
      * @param $sql
      * @return false|int
     */
     public function exec($sql)
     {
         try {
             return $this->connection->exec($sql);
         } catch (PDOException $e) {
             exit($e->getMessage());
         }
     }


     /**
      * @param callable $callback
     */
     public function transaction(callable $callback)
     {
         try {

             $this->connection->beginTransaction();
             call_user_func($callback, $this);
             $this->connection->commit();

         } catch (PDOException $e) {

             $this->connection->rollBack();
             die($e->getMessage());
         }
     }


     /**
      * Fetch all results
      *
      * @param int $fetchStyle
      * @return array
      * @throws Exception
     */
     public function fetchAll($fetchStyle = PDO::FETCH_OBJ)
     {
         if($this->classMap)
         {
             return $this->getCurrentStatement()
                         ->fetchAll(PDO::FETCH_CLASS, $this->classMap);
         }

         return $this->getCurrentStatement()->fetchAll($fetchStyle);
     }


     /**
      * Get first result
      *
      * @return array
      * @throws Exception
     */
     public function getFirstResult()
     {
         return $this->fetchAll()[0] ?? null;
     }


     /**
      * Fetch one result
      *
      * @param int $fetchStyle
      * @return mixed
      * @throws Exception
     */
     public function fetchOne($fetchStyle = PDO::FETCH_OBJ)
     {
         // TO FIX
//         if($this->classMap)
//         {
//             return $this->getCurrentStatement()
//                         ->fetch(PDO::FETCH_CLASS, $this->classMap);
//         }

         // return $this->getCurrentStatement()->fetch($fetchStyle);
     }


     /**
      * Get row count
      *
      * @return int
      * @throws Exception
     */
     public function count()
     {
         return $this->getCurrentStatement()->rowCount();
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
      * @return array
     */
     public function executedSql()
     {
         return $this->executedSql;
     }


    /**
     * Get statement
     *
     * @return PDOStatement
     * @throws StatementException
     */
     public function getCurrentStatement()
     {
         if(is_null($this->stmt))
         {
             throw new StatementException(
                 'Can not executed because there are not statement yet executed!'
             );
         }

         return $this->stmt;
     }


    /**
     * @param $connection
     * @return mixed|void
    */
    public function addConnection($connection)
    {
        $this->connection = $connection;
    }


    /**
     * @return mixed|PDO
    */
    public function getConnection()
    {
        return $this->connection;
    }
}

