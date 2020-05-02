<?php
namespace Jan\Component\DependencyInjection;


use Jan\Component\DependencyInjection\Contracts\ContainerInterface;


/**
 * Class Container
 * @package Jan\Component\DependencyInjection
*/
class Container // implements \ArrayAccess, ContainerInterface
{

    /** @var array  */
    protected $binds = [];


    /** @var array  */
    protected $instances = [];


    /** @var array  */
    protected $aliases = [];


    /** @var array  */
    protected $providers = [];


    /** @var array  */
    protected $provides  = [];


    /** @var array  */
    protected $boots = [];


    /**
     * @param $abstract
     * @param $concrete
     * @param bool $singleton
     * @return Container
    */
    public function bind($abstract, $concrete, $singleton = false)
    {
         $this->binds[$abstract] = compact('concrete', 'singleton');

         return $this;
    }


    /**
     * Sharing given key as singleton
     *
     * @param $abstract
     * @param $concrete
    */
    public function share($abstract, $concrete)
    {
         $this->instances[$abstract] = function () use ($concrete){

              $instance = null;

              if(! $instance)
              {
                  $instance = $concrete;
              }

              return $concrete;
         };
    }


    /**
     * Singleton
     *
     * @param $abstract
     * @param $concrete
    */
    public function singleton($abstract, $concrete)
    {
        $this->bind($abstract, $concrete, true);
    }


    /**
     * Create new instance of object wit given params
     *
     * @param $abstract
     * @param array $parameters
     * @return bool
    */
    public function make($abstract, $parameters = [])
    {
         return $this->resolve($abstract, $parameters);
    }


    /**
     * Factory
     *
     * @param $abstract
     * @return bool
    */
    public function factory($abstract)
    {
        return $this->make($abstract);
    }

    /**
     * Determine if the given id has binded
     *
     * @param $id
     * @return bool
    */
    public function has($id)
    {
        // is binded ?
        if(isset($this->binds[$id]))
        {
            return true;
        }

        // is alias ?
        if(isset($this->aliases[$id]))
        {
            return true;
        }


        return false;
    }


    /**
     * Get value given abstract key
     *
     * @param $abstract
     * @param array $arguments
     * @return bool
    */
    public function get($abstract, $arguments = [])
    {
           if(! $this->has($abstract))
           {
               return $this->resolve($abstract, $arguments);
           }

           dump($abstract, $arguments);
    }


    /**
     * Resolve dependency
     *
     * @param $abstract
     * @param $arguments
     * @return bool
    */
    public function resolve($abstract, $arguments)
    {
         return true;
    }
}