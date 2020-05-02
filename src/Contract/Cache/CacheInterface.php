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
      * Check if the specified cache key exists
      *
      * @param string $key
      * @return bool
     */
    public function has($key);
}

