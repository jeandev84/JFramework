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

    /** @var string */
    protected $sql;


    /** @var array  */
    protected $params = [];


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
     * @param string|null $classMap
     */
     public function __construct(PDO $connection, string $classMap = null)
     {
         $this->addConnection($connection);
         $this->registerClassMap($classMap);
     }



     /**
      * @param string|null $sql
      * @param array $params
      * @return Statement
     */
     public function execute(string $sql = null, array $params = [])
     {
         try {

             $this->stmt = $this->connection->prepare($sql);

             if($this->stmt->execute($params))
             {
                 $this->executedSql[] = compact('sql', 'params');
             }

         } catch (PDOException $e) {

             throw $e;
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

             $this->connection->exec($sql);

         } catch (PDOException $e) {
             throw $e;
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
             throw $e;
         }
     }


     /**
      * Fetch all results
      *
      * @param int $fetchStyle
      * @return array
      * @throws Exception
     */
     public function getResults($fetchStyle = PDO::FETCH_OBJ)
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
         return $this->getResults()[0] ?? null;
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
         if(! $this->stmt)
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


    /**
     * @param string $sql
     * @return mixed
     */
    public function addSql(string $sql)
    {
        $this->sql = $sql;

        return $this;
    }

    /**
     * @param array $values
     * @return mixed
    */
    public function addValues(array $values = [])
    {
        $this->params = $values;

        return $this;
    }


    /**
     * @param string|null $classMap
     * @return Statement
    */
    public function registerClassMap(?string $classMap)
    {
        $this->classMap = $classMap;

        return $this;
    }

}

