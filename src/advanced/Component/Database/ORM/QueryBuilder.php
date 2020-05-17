<?php
namespace Jan\Component\Database\ORM;


use Jan\Component\Database\Contracts\QueryBuilderInterface;

/**
 * Class QueryBuilder
 * @package Jan\Component\Database\ORM
*/
class QueryBuilder implements QueryBuilderInterface
{

    /** @var array  */
    private $sqlParts = [
        'select' => [],
        'from'   => [],
        'where'  => [],
        //'and'    => [],
        //'in'     => [],
        'limit'  => [],
        'join'   => [],
        'insert' => [],
        'update' => []
    ];


    /**
     * @param string $type
     * @param $expr
     * @return $this
    */
    public function addSql(string $type, $expr)
    {
        $this->sqlParts[$type] = $expr;
        return $this;
    }


    /**
     * @param string $sql
     * @return QueryBuilder
     */
    public function expr(string $sql)
    {
         return $this;
    }

    /**
     * @param $method
     * @param $arguments
     * @return $this
    */
    public function __call($method, $arguments)
    {
        if(\array_key_exists($method, $this->sqlParts))
        {
             // reflection method
        }

        return $this;
    }


    /**
     * @return string
    */
    public function __toString()
    {
        return '';
    }
}