<?php
namespace Jan\Component\DependencyInjection;


use Closure;
use Jan\Component\DependencyInjection\Contracts\BootableServiceProvider;
use Jan\Component\DependencyInjection\Contracts\ContainerInterface;
use Jan\Component\DependencyInjection\Exceptions\InstanceException;
use Jan\Component\DependencyInjection\Exceptions\ResolverDependencyException;
use Jan\Component\DependencyInjection\ServiceProvider\AbstractServiceProvider;
use ReflectionClass;
use ReflectionException;


/**
 * Class Container
 * @package Jan\Component\DependencyInjection
*/
class Container implements \ArrayAccess, ContainerInterface
{

    /** @var Container */
    protected static $instance;


    /** @var array  */
    protected $bindings = [];


    /** @var array  */
    protected $instances = [];


    /** @var array  */
    protected $aliases = [];


    /** @var array  */
    protected $boots = [];


    /** @var array  */
    protected $registers = [];


    /** @var array  */
    protected $providers = [];


    /** @var array  */
    protected $provides  = [];



    /** @var array  */
    protected $calls = [];


    /**
     * @var bool
    */
    protected $autowire = true;


    /**
     * @return Container
     *
     * (! static::$instance)
     * is_null(static::$instance)
    */
    public static function getInstance()
    {
        if(! isset(static::$instance))
        {
            static::$instance = new static();
        }

        return static::$instance;
    }


    /**
     * @param $abstract
     * @param $concrete
     * @param bool $singleton
     * @return Container
    */
    public function bind($abstract, $concrete, $singleton = false)
    {
         if(is_null($concrete))
         {
             $concrete = $abstract;
         }

         $this->bindings[$abstract] = compact('concrete', 'singleton');

         return $this;
    }


    /**
     * Bind from configuration
     *
     * @param array $configs
     * @return Container
    */
    public function bindings(array $configs)
    {
        foreach ($configs as $config)
        {
            list($abstract, $concrete, $singleton) = $config;
            $this->bind($abstract, $concrete, $singleton);
        }

        return $this;
    }


    /**
     * Set autowiring status
     *
     * @param bool $status
     * @return $this
    */
    public function autowire(bool $status)
    {
        $this->autowire = $status;

        return $this;
    }


    /**
     * Add Service Provider
     * @param string|AbstractServiceProvider $provider
     * @return Container
     * @throws ReflectionException
     *
     *  Example:
     *  $this->addServiceProvider(new \App\Providers\AppServiceProvider());
     *  $this->addServiceProvider(App\Providers\AppServiceProvider::class);
     *
     */
    public function addServiceProvider($provider)
    {
        if(is_string($provider))
        {
            $provider = $this->factory($provider);
        }

        if($provider instanceof AbstractServiceProvider)
        {
            $this->providers[] = $provider;

            if($provides = $provider->getProvides())
            {
                $this->provides[get_class($provider)] = $provides;
            }

            $this->runServiceProvider($provider);
        }

        return $this;
    }


    /**
     * @param array $providers
     * @throws ReflectionException
    */
    public function addServiceProviders(array $providers)
    {
           if(! $providers) return;

           foreach ($providers as $provider)
           {
               $this->addServiceProvider($provider);
           }
    }


    /**
     * @param AbstractServiceProvider $provider
    */
    public function runServiceProvider(AbstractServiceProvider $provider)
    {
          $provider->setContainer($this);

          $implements = class_implements($provider);
          $providerClass = get_class($provider);

          if(! \in_array($providerClass, $this->boots))
          {
              if(isset($implements[BootableServiceProvider::class]))
              {
                   $provider->boot();
                   $this->boots[] = $providerClass;
              }
          }

          if(! \in_array($providerClass, $this->registers))
          {
                  $provider->register();
                  $this->registers[] = $providerClass;
          }
    }



    /**
     * @return array
     */
    public function getProviders()
    {
        return $this->providers;
    }


    /**
     * @return array
    */
    public function getProvides()
    {
        return $this->provides;
    }


    /**
     * @return array
    */
    public function getRegisters()
    {
        return $this->registers;
    }

    /**
     * Set instance
     *
     * @param $abstract
     * @param $instance
    */
    public function instance($abstract, $instance)
    {
        $this->instances[$abstract] = $instance;
    }


    /**
     * Determine if has instantiated abstract
     *
     * @param $abstract
     * @return bool
    */
    public function instantiated($abstract)
    {
        return isset($this->instances[$abstract]);
    }


    /**
     * @return array
    */
    public function getInstances()
    {
        return $this->instances;
    }


    /**
     * Determine if has alias
     *
     * @param $alias
     * @return bool
    */
    public function hasAlias($alias)
    {
        return \array_key_exists($alias, $this->aliases);
    }


    /**
     * @param $alias
     * @return bool|mixed
    */
    public function getAlias($alias)
    {
        if(! $this->hasAlias($alias))
        {
            return false;
        }

        return $this->aliases[$alias];
    }

    /**
     * @param $abstract
     * @param $alias
    */
    public function alias($abstract, $alias)
    {
         if(! isset($this->aliases[$alias]))
         {
              $this->aliases[$alias] = $abstract;
         }
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
     * Determine if given abstract is singleton
     * @param $abstract
     * @return bool
    */
    public function isSingleton($abstract)
    {
        return (isset($this->bindings[$abstract]['singleton'])
            && $this->bindings[$abstract]['singleton'] === true);
    }


    /**
     * @param $abstract
     * @param $concrete
     * @return mixed
    */
    protected function getSingleton($abstract, $concrete)
    {
        if(! isset($this->instances[$abstract]))
        {
            $this->instances[$abstract] = $concrete;
        }

        return $this->instances[$abstract];
    }


    /**
     * Create new instance of object wit given params
     *
     * @param $abstract
     * @param array $parameters
     * @return object
     * @throws ReflectionException
    */
    public function make($abstract, $parameters = [])
    {
         return $this->resolve($abstract, $parameters);
    }


    /**
     * Factory
     *
     * @param $abstract
     * @return object
     * @throws ReflectionException
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
        if($this->bounded($id))
        {
            return true;
        }

        // is alias ?
        if($this->hasAlias($id))
        {
            return true;
        }

        return false;
    }


    /**
     * Determine if id bounded
     * @param $id
     * @return bool
    */
    public function bounded($id)
    {
        return isset($this->bindings[$id]);
    }


    /**
     * Get value given abstract key
     *
     * @param $abstract
     * @param array $arguments
     * @return object
     * @throws ReflectionException|InstanceException
     *
     * dump($container->get(App\Controllers\HomeController::class, [
            * 'id' => 1,
            * 'slug' => 'salut-les-amis',
             * 3
     * ]));
    */
    public function get($abstract, $arguments = [])
    {
           // resolve abstract
           if(! $this->has($abstract))
           {
               if($this->autowire !== true)
               {
                    throw new ResolverDependencyException(
                        'Autowire is unabled for resolution'
                    );
               }
               return $this->resolve($abstract, $arguments);
           }

           // get instance
           if($this->instantiated($abstract))
           {
               return $this->instances[$abstract];
           }

           // get aliases
           /*
           if($alias = $this->getAlias($abstract))
           {
               return $this->getConcrete($alias);
           }
           */

           $concrete = $this->getConcrete($abstract);

           // get singleton
           if($this->isSingleton($abstract))
           {
               return $this->getSingleton($abstract, $concrete);
           }

           // get concrete
           return $concrete;
    }


    /**
     * @param $abstract
     * @return mixed
    */
    public function getConcrete($abstract)
    {
        $concrete = $this->bindings[$abstract]['concrete'] ?? null;

        if($concrete instanceof Closure)
        {
            return $concrete($this);
        }

        return $concrete;
    }


    /**
     * Resolve dependency
     *
     * @param $abstract
     * @param array $arguments
     * @return object
     * @throws ReflectionException|InstanceException
    */
    public function resolve($abstract, array $arguments = [])
    {
          $reflectedClass = new ReflectionClass($abstract);

          // for example if constructor has modificator private (not accessible)
          if(! $reflectedClass->isInstantiable())
          {
              throw new InstanceException(
                  sprintf('Class [%s] is not instantiable dependency.', $abstract)
              );
          }

          if(! $constructor = $reflectedClass->getConstructor())
          {
                return $this->instances[$abstract] = $reflectedClass->newInstance();
          }

          $dependencies = $this->resolveMethodDependencies($constructor, $arguments);
          return $this->instances[$abstract] = $reflectedClass->newInstanceArgs($dependencies);
    }


    /**
     * Resolve method dependencies
     *
     * @param \ReflectionMethod $reflectionMethod
     * @param array $arguments
     * @return array
     *
     * $object->method(FileSystem $fileSystem, User $user)
     *  parameter name [fileSystem, user]
     *  dependency is class name [FileSystem, User] typeHint
     * @throws ReflectionException|InstanceException
     */
    public function resolveMethodDependencies(\ReflectionMethod $reflectionMethod, $arguments = [])
    {
        $dependencies = [];

        foreach ($reflectionMethod->getParameters() as $parameter)
        {
            $dependency = $parameter->getClass();

            if($parameter->isOptional()) { continue; }
            if($parameter->isArray()) { continue; }

            if(is_null($dependency))
            {
                if($parameter->isDefaultValueAvailable())
                {
                    $dependencies[] = $parameter->getDefaultValue();
                }else{

                    if(array_key_exists($parameter->getName(), $arguments))
                    {
                        $dependencies[] = $arguments[$parameter->getName()];
                    }else {

                        $dependencies = array_merge($dependencies,
                            array_filter($arguments, function ($key) {
                                return is_numeric($key);
                        }, ARRAY_FILTER_USE_KEY));

                    }
                }

            } else{

                $dependencies[] = $this->get($dependency->getName());
            }
        }

        return $dependencies;
    }




    /**
     * @param mixed $offset
     * @return bool
     */
    public function offsetExists($offset)
    {
        return $this->has($offset);
    }



    /**
     * @param mixed $offset
     * @return mixed
     */
    public function offsetGet($offset)
    {
        return $this->get($offset);
    }



    /**
     * @param mixed $offset
     * @param mixed $value
   */
    public function offsetSet($offset, $value)
    {
        $this->bind($offset, $value);
    }



    /**
     * @param mixed $offset
    */
    public function offsetUnset($offset)
    {
        unset($this->bindings[$offset]);
    }
}