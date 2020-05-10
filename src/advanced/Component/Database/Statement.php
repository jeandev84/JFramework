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
     * @return mixed|PDO
    */
    public function getConnection()
    {
        return $this->connection;
    }


    /**
     * @param $connection
     * @return mixed
    */
    public function addConnection($connection)
    {
        $this->connection = $connection;
    }


    /**
     * @param string|null $sql
     * @param array $params
     * @return PDOStatement
     */
     public function execute(string $sql = null, array $params = []): PDOStatement
     {
         try {

             $this->stmt = $this->connection->prepare($sql);

             if($this->isExecuted($params))
             {
                 $this->executedSql[] = compact('sql', 'params');
             }

         } catch (PDOException $e) {

             throw $e;
         }

         return $this->stmt;
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
      * Get row count
      *
      * @return int
      * @throws Exception
     */
     public function count()
     {
         return $this->ensuredStatement()->rowCount();
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
      * @return mixed|void
      * @throws StatementException
     */
     public function getResults()
     {
         return $this->ensuredStatement()
                     ->fetchAll(PDO::FETCH_OBJ);
     }


     /**
      * Get statement
      *
      * @return PDOStatement
      * @throws StatementException
     */
     private function ensuredStatement()
     {
         if(! $this->hasStatement())
         {
             throw new StatementException(
                 'Can not executed because there are not statement yet executed!'
             );
         }

         return $this->stmt;
     }


    /**
     * @return bool
    */
    private function hasStatement()
    {
        return $this->stmt instanceof PDOStatement;
    }


    /**
     * @param array $params
     * @return bool
    */
    private function isExecuted(array $params)
    {
        return $this->stmt->execute($params);
    }
}

