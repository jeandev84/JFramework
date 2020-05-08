<?php
namespace Jan\Component\Helpers\Serialise;




/**
 * Class Serialiser
 * @package Jan\Component\Helpers\Serialise
*/
class Serialiser
{

     /** @var array  */
     protected $cache = [];


     /**
      * @param $name
      * @param $context
      * @return string
     */
     public function serialise($name, $context)
     {
         $this->cache[$name] = serialize($context);
     }

     /**
      * @param $name
      * @return bool
     */
     public function serialised($name)
     {
         return isset($this->cache[$name]);
     }

    /**
     * @param $name
     * @return mixed
     * @throws \Exception
     */
     public function deserialise($name)
     {
          if(! $this->serialised($name))
          {
             $this->abortIf(sprintf('This name %s is not serialized!', $name));
          }
          return unserialize($this->cache[$name]);
     }

     /**
      * @param $message
      * @throws \Exception
     */
     protected function abortIf($message)
     {
         throw new \Exception($message);
     }
}

/*
Example:

spl_autoload_register(function ($classname) {
    $path =  __DIR__. str_replace(['\\', '/'], DIRECTORY_SEPARATOR, $classname);
    @require_once $path.'.php';
});


# Object
$user = new \App\Entity\User();
$user->setName('jean');
$user->setEmail('jeanyao@ymail.com');
$user->setPassword('secret');

$serialiser = new Serialiser();
$serialiser->serialise('user.id', $user);

try {

    $context = $serialiser->deserialise('user.id');
    dump($context);
} catch (\Exception $e) {

    dump($e->getMessage());

}
*/