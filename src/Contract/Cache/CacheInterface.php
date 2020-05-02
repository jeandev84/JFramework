<?php
namespace Jan\Contract\Cache;


use Jan\Contract\Storage\StorageInterface;

/**
 * Interface CacheInterface as Cacheable
 * @package Jan\Contract\Cache
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

