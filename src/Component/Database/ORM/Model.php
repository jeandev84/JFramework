<?php
namespace Jan\Component\Database\ORM;


/**
 * Class Model
 * @package Jan\Component\Database\ORM
*/
abstract class Model extends ActiveRecord implements \ArrayAccess
{

     /** @var string */
     protected $table;


     /** @var array  */
     protected $fillable = [];


     /** @var array  */
     protected $guard = [];


    public function offsetExists($offset)
    {
        // TODO: Implement offsetExists() method.
    }

    public function offsetGet($offset)
    {
        // TODO: Implement offsetGet() method.
    }

    public function offsetSet($offset, $value)
    {
        // TODO: Implement offsetSet() method.
    }

    public function offsetUnset($offset)
    {
        // TODO: Implement offsetUnset() method.
    }
}