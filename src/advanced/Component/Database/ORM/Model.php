<?php
namespace Jan\Component\Database\ORM;


use Jan\Component\Database\Connection;
use Jan\Component\Database\Connectors\PDO\Query;
use Jan\Component\Database\Contracts\EntityInterface;
use Jan\Component\Database\Contracts\EntityManagerInterface;
use Jan\Component\Database\Contracts\EntityRepositoryInterface;
use Jan\Component\Database\Contracts\ManagerInterface;
use Jan\Component\Database\Exceptions\ConnectionException;
use ReflectionException;


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
      * @return mixed
      * @throws ConnectionException
     */
     public static function connection()
     {
         return Connection::instance();
     }
     
     
     /**
      * @return EntityManager
      * @throws ConnectionException
     */
     public function manager()
     {
         return new EntityManager(self::connection());
     }


     /**
      * @return EntityRepository
      * @throws ConnectionException|ReflectionException
      */
     public static function repository()
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
      * @param string $condition
      * @param $value
      * @return string
      * @throws ConnectionException|ReflectionException
     */
     public static function where($condition, $value)
     {
         return self::repository()->where($condition, $value);
     }


     /**
      * Get all record
      * @return mixed
      * @throws ConnectionException
      * @throws ReflectionException
     */
     public static function all()
     {
         return self::repository()->findAll();
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