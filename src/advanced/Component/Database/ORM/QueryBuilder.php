<?php
namespace Jan\Component\Database\ORM;


use Jan\Component\Database\Contracts\ManagerInterface;
use Jan\Component\Database\Contracts\QueryBuilderInterface;
use Jan\Component\Database\ORM\Builder\Contract\SqlBuilder;
use Jan\Component\Database\ORM\Builder\From;
use Jan\Component\Database\ORM\Builder\Select;

/**
 * Class QueryBuilder
 * @package Jan\Component\Database\ORM
*/
class QueryBuilder implements QueryBuilderInterface
{

    /** @var array  */
    private $sqlParts = [];



    /** @var ManagerInterface */
    private $manager;


    /**
     * QueryBuilder constructor.
    */
    public function __construct()
    {
         // $this->reset();
    }


    /**
     * @param null $selects
     * @return $this
    */
    public function select($selects = null)
    {
        return $this->addSql(new Select($selects));
    }


    /**
     * @param $table
     * @param null $alias
     * @return $this
    */
    public function from($table, $alias = null)
    {
        return $this->addSql(new From(compact('table', 'alias')));
    }


    /**
     * @param SqlBuilder $builder
     * @param bool $remove
     * @return $this
    */
    public function addSql(SqlBuilder $builder = null, bool $remove = false)
    {
        if($remove === true)
        {
            $this->reset();
        }

        if(! $builder)
        {
            return $this;
        }

        $this->sqlParts[$builder->getType()] = $builder;

        return $this;
    }


    public function getSql()
    {
        return '';
    }



    /**
     * @return string
     */
    public function __toString()
    {
        return '';
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
     * @param ManagerInterface $manager
    */
//    public function addQuery(ManagerInterface $manager)
//    {
//        $this->manager = $manager;
//    }
//
//
//    public function getQuery(ManagerInterface $manager)
//    {
//        $this->manager->registerSql($this->getSql());
//        return $this->manager;
//    }


    /**
     * @return void
    */
    protected function reset()
    {
        $this->sqlParts = [];
    }
}


/*
private $sqlParts = [
'select'      => [],
'from'        => [],
'conditions'  => [],
'limit'       => [],
'join'        => [],
'insert'      => [],
'update'      => []
];
*/