<?php
namespace Jan\Routing\Review;


/**
 * Class Route
 * @package Jan\Routing\Review
*/
class Route
{

     /** @var array  */
     protected $methods = [];


     /** @var string */
     protected $path;


     /** @var mixed */
     protected $target;


     /** @var string */
     protected $name;


     /** @var array  */
     protected $namedRoutes = [];


     /** @var array  */
     protected $middlewares = [];


    /**
     * Route constructor.
     * @param array $methods
     * @param string $path
     * @param $target
     * @param string $name
     */
     public function __construct(array $methods, string $path, $target, string $name = null)
     {
         $this->methods = $methods;
         $this->path = $path;
         $this->target = $target;
         $this->name = $name;
     }


     /**
      * @param string $name
      * @return Route
     */
     public function name(string $name)
     {
          $this->namedRoutes[$name] = $this->path;

          return $this;
     }
}