<?php
namespace Jan\Component\Helpers\Collections;


/**
 * Class ArrayCollection
 * @package Jan\Component\Helpers\Collections
*/
class ArrayCollection implements \ArrayAccess, \Iterator
{

    /** @var array  */
    protected $items = [];


    /**
     * ArrayCollection constructor.
     * @param array $items
    */
    public function __construct(array $items = [])
    {
        $this->items = $items;
    }


    /**
     * @param $key
     * @param $value
    */
    public function add($key, $value)
    {
         $this->items[$key] = $value;
    }

    public function current()
    {
        // TODO: Implement current() method.
    }

    public function next()
    {
        // TODO: Implement next() method.
    }

    public function key()
    {
        // TODO: Implement key() method.
    }

    public function valid()
    {
        // TODO: Implement valid() method.
    }

    public function rewind()
    {
        // TODO: Implement rewind() method.
    }

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