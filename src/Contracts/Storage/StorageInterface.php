<?php
namespace Jan\Contracts\Storage;


/**
 * interface StorageInterface
 * @package Jan\Contracts\Storage
*/
interface StorageInterface
{

    /**
     * Set data in storage
     *
     * @param $key
     * @param $value
     * @return mixed
    */
    public function set($key, $value);


    /**
     * Get data from storage
     *
     * @param $key
     * @return mixed
    */
    public function get($key);


    /**
     * Remove data from storage
     *
     * @param $key
     * @return mixed
    */
    public function delete($key);


    /**
     * Remove all stored data
     *
     * @return mixed
    */
    public function destroy();


    /**
     * Get all stored
     *
     * @return mixed
    */
    public function all();
}