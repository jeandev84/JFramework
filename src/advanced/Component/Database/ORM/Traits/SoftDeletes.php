<?php
namespace Jan\Component\Database\ORM\Traits;


/**
 * Trait SoftDeletes
 * @package Jan\Component\Database\ORM\Traits
*/
trait SoftDeletes
{

    /** @var bool  */
    protected $softDelete = true;


    /**
     * @return bool
    */
    protected function isSoftDeleted()
    {
        return $this->softDelete === true;
    }

    /*
    protected function toReview()
    {
        return $this->softDelete === true;
        || property_exists($this, 'deletedAt');
        \in_array('deleted_at', $mappedProperties)
    }
    */
}