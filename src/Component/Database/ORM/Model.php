<?php
namespace Jan\Component\Database\ORM;


/**
 * Class Model
 * @package Jan\Component\Database\ORM
*/
class Model implements \ArrayAccess
{


     use ActiveRecord;


     /** @var string */
     protected $table;


     /** @var array  */
     protected $attributes = [];


     /** @var array  */
     protected $fillable = [];


     /** @var array  */
     protected $guard = ['id'];



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
      * @return string
     */
     protected function tableName()
     {
          return $this->table;
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