<?php
namespace Jan\Component\Database\ORM;


use Jan\Component\Database\Connection;
use Jan\Component\Database\Connectors\PDO\Query;
use Jan\Component\Database\Contracts\EntityInterface;
use Jan\Component\Database\Contracts\EntityManagerInterface;
use Jan\Component\Database\Contracts\EntityRepositoryInterface;
use Jan\Component\Database\Contracts\ManagerInterface;
use Jan\Component\Database\Exceptions\ConnectionException;


/**
 * Class Model
 * @package Jan\Component\Database\ORM
*/
class Model extends AbstractEntity implements \ArrayAccess
{

     /** @var array  */
     protected $attributes = [];


     /** @var array  */
     protected $fillable = [];


     /** @var string[]  */
     protected $guard = ['id'];


     /** @var array  */
     protected $hidden = [];


     /**
      * @return EntityManager
      * @throws ConnectionException
     */
     public function getManager()
     {
         return new EntityManager(Connection::instance());
     }


     /**
      * @return EntityRepository
      * @throws ConnectionException|\ReflectionException
      */
     public static function getRepository()
     {
         return new EntityRepository(self::getQuery(), static::class);
     }


     /**
      * @return Query
      * @throws ConnectionException
     */
     public static function getQuery()
     {
         return new Query(Connection::instance());
     }


     /**
      * @param string $condition
      * @param $value
      * @return string
      * @throws ConnectionException|\ReflectionException
      */
     public static function where($condition, $value)
     {
         return self::getRepository()->where($condition, $value);
     }



     /**
      * Get all record
      * @return mixed
      * @throws \ReflectionException
      * @throws ConnectionException
     */
     public static function get()
     {

     }



    /**
     * Save data to the database
     */
    public function save()
    {
        // implements some methods for fillable
        // guarded

        // $this->entityManager->persist($this);
        // $this->entityManager->flush();
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