<?php


namespace Jan\Component\FileSystem;


/**
 * Class FileSystem
 * @package Jan\Component\FileSystem
 *
 * Author Jean-Claude
 * Email <jeanyao@ymail.com>
*/
class FileSystem extends File
{
     /**
      * FileSystem constructor.
      * @param string $resource
     */
     public function __construct(string $resource)
     {
         parent::__construct($resource);
     }
}