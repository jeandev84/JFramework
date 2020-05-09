<?php
namespace Jan\Contracts\Cache;


use Jan\Contracts\Storage\StorageInterface;

/**
 * Interface CacheInterface as Cacheable
 * @package Jan\Contracts\Cache
*/
interface CacheInterface extends StorageInterface
{


    /**
     * @param $key
     * @param $data
     * @param null $duration
     * @return mixed
    */
    public function set($key, $data, $duration = null);

}

