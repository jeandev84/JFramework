<?php
namespace Jan\Component\Database\Migration;


use PDO;


/**
 * Class Migration
 * @package Jan\Component\Database\Migration
*/
abstract class Migration
{

    /** @var PDO $connection */
    protected $connection;


    /**
     * Migration constructor.
     * @param PDO $connection
    */
    public function __construct(PDO $connection)
    {
         $this->connection = $connection;
    }


    /**
     * @param string $sql
    */
    public function addSql(string $sql)
    {
         //
    }


    /**
     * @param string $column
     * @return $this
    */
    public function addColumn(string $column)
    {
        return $this;
    }


    /**
     * @return void
    */
    abstract public function up();


    /**
     * @return void
    */
    abstract public function down();
}