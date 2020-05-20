<?php
namespace Jan\Component\Database\ORM;


use Exception;
use Jan\Component\Database\Connection;
use Jan\Component\Database\Connectors\PDO\Query;
use Jan\Component\Database\Exceptions\ConnectionException;
use ReflectionException;
use ReflectionObject;

/**
 * Abstract Class ModelRepository
 * @package Jan\Component\Database\ORM
*/
abstract class ModelRepository implements \ArrayAccess
{

    use Generator;


    /** @var array  */
    protected $attributes = [];


    /** @var string */
    protected $table;


    /**
     * Get table name
     * @return string
     * @throws \ReflectionException
    */
    public function getTable()
    {
       if(! $this->table)
       {
           return $this->generateTableNameOfEntity(static::class);
       }

       return $this->table;
    }


    /**
     * @return mixed
     * @throws ConnectionException
    */
    protected static function connection()
    {
        return Connection::instance();
    }


    /**
     * @return EntityManager
     * @throws ConnectionException
    */
    protected function manager()
    {
        return new EntityManager(self::connection());
    }


    /**
     * @return EntityRepository
     * @throws ConnectionException|ReflectionException
    */
    protected static function repository()
    {
        return new EntityRepository(self::query(), static::class);
    }


    /**
     * @return Query
     * @throws ConnectionException
    */
    public static function query()
    {
        return new Query(self::connection());
    }


    /**
     * Map columns
    */
    public function getTableColumns()
    {
        $sql = 'SHOW COLUMNS FROM '. $this->getTable();
        $columnProperties = self::query()->execute($sql)->get();
        $columns = [];

        foreach ($columnProperties as $column)
        {
             $columns[] = $column->Field;
        }

        return $columns;
    }


    /**
     * @param $field
     * @param $value
    */
    public function setAttribute($field, $value)
    {
        $this->attributes[$field] = $value;
    }


    /**
     * @param $field
     * @return bool
    */
    public function hasAttribute($field)
    {
        return isset($this->attributes[$field]);
    }


    /**
     * @param $field
    */
    public function removeAttribute($field)
    {
        if($this->hasAttribute($field))
        {
            unset($this->attributes[$field]);
        }
    }


    /**
     * @param $field
     * @return array
    */
    public function getAttribute($field)
    {
        if(! $this->hasAttribute($field))
        {
            return null;
        }
        return $this->attributes[$field];
    }


    /**
     * @param $field
     * @param $value
    */
    public function __set($field, $value)
    {
        $this->setAttribute($field, $value);
    }


    /**
     * @param $field
     * @return mixed
    */
    public function __get($field)
    {
        return $this->getAttribute($field);
    }



    /**
     * @param mixed $offset
     * @return bool
    */
    public function offsetExists($offset)
    {
        return $this->hasAttribute($offset);
    }


    /**
     * @param mixed $offset
     * @return mixed|void
    */
    public function offsetGet($offset)
    {
        return $this->getAttribute($offset);
    }


    /**
     * @param mixed $offset
     * @param mixed $value
    */
    public function offsetSet($offset, $value)
    {
        $this->setAttribute($offset, $value);
    }



    /**
     * @param mixed $offset
    */
    public function offsetUnset($offset)
    {
        $this->removeAttribute($offset);
    }
}