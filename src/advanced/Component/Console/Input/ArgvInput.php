<?php
namespace Jan\Component\Console\Input;


/**
 * Class ArgvInput
 * @package Jan\Component\Console\Input
 *
 * //TODO more advanced
 */
class ArgvInput implements InputInterface
{

     /**
      * @var array
     */
     private $server = [];

     /**
      * Argv constructor.
      * @param array $server
     */
     public function __construct()
     {
          $this->server = array_merge($this->server, $_SERVER);
     }

     /**
      * @param int $position
      * @return mixed|null
      * @throws \Exception
     */
     public function getValue($position = 0)
     {
         return $this->getArguments()[$position] ?? null;
     }

     /**
      * Get all parses values
      *
      * @return mixed|null
      * @throws \Exception
     */
     public function getArguments()
     {
        return $this->getParameter('argv');
     }

     /**
      * Get count
      *
      * @return mixed|null
      * @throws \Exception
     */
     public function count()
     {
         return $this->getParameter('argc');
     }

     /**
      * Get argument from server
      *
      * @param $key
      * @return mixed|null
      * @throws \Exception
     */
     public function getParameter($key)
     {
         if(! $this->hasParameter($key))
         {
             throw new \Exception(sprintf('parameter (%s) is not setted!', $key));
         }

         return $this->server[$key];
     }

     /**
       * @param $key
       * @return bool
     */
     public function hasParameter($key)
     {
         return isset($this->server[$key]);
     }

     /**
      * @param int $position
      * @return mixed|string|null
      * @throws \Exception
     */
     public function getArgument()
     {
          $arguments = $this->getArguments();
          array_shift($arguments);
          $parsed = implode($arguments);

          return $this->resolvedArgument($parsed);
     }

    /**
     * @param $argument
     * @return string|string[]
     */
    private function resolvedArgument($argument)
    {
        return str_replace(' ', '', trim($argument));
    }
}