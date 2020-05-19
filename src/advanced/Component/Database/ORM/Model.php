<?php
namespace Jan\Component\Database\ORM;


use Illuminate\Support\Manager;
use Jan\Component\Database\Contracts\EntityInterface;
use Jan\Component\Database\Contracts\EntityManagerInterface;
use Jan\Component\Database\Contracts\EntityRepositoryInterface;
use Jan\Component\Database\Contracts\ManagerInterface;

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


     /** @var EntityManagerInterface */
     private $entityManager;


     private static $repository;


     /**
      * Model constructor.
      * @param EntityManagerInterface $entityManager
     */
     public function __construct(EntityManagerInterface $entityManager)
     {
          $this->entityManager = $entityManager;
          self::$repository = $this->entityManager->getRepository();
     }


     /**
      * @param EntityManagerInterface $entityManager
      * @return Model
     */
     public function addEntityManager(EntityManagerInterface $entityManager)
     {
         $repository = $entityManager->getRepository();
         $repository->registerClassMap(static::class);
         $repository->registerTable($this->table);
         self::$repository = $repository;

         return $this;
     }


     /**
      * @return string
     */
     public function getTable()
     {
         return $this->table;
     }


     /**
      * Get all record
      * @return mixed
     */
     public function get()
     {
          return self::getRepository()->findAll();
     }



     /**
      * @param $column
      * @param $operator
      * @param $value
      * @return Model
     */
     public static function where($column, $operator, $value)
     {

         return new static;
     }


     /**
      * Get entity repository
     */
     public static function getRepository()
     {
          return self::$repository;
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