<?php
namespace Jan\Component\Database\ORM;


/**
 * Class AbstractEntity
 * @package Jan\Component\Database\ORM
*/
abstract class AbstractEntity /* implements \ArrayAccess */
{

    use Generator;


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
           return $this->generateNameOfEntityTable(static::class);
       }

       return $this->table;
    }
}