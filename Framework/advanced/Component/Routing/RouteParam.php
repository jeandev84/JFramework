<?php
namespace Jan\Component\Routing;



/**
 * Class RouteParam
 * @package Jan\Component\Routing
*/
class RouteParam
{

      /** @var array */
      private $route;


     /**
      * RouteManager constructor.
      * @param array $route
     */
      public function __construct($route)
      {
           $this->route = $route;
      }

      /**
       * @param bool $inline
       * @return mixed
      */
      public function getMethods($inline = false)
      {
          $methods =  $this->getParameter('methods');
          return ($inline === true && $methods) ? implode('|', $methods) : $methods;
      }


      /**
       * @return string
      */
      public function getPath()
      {
          return $this->getParameter('path');
      }


      /**
       * @return mixed
      */
      public function getTarget()
      {
          return $this->getParameter('target');
      }


      /**
        * @return array
      */
      public function getControllerAndAction()
      {
          if(isset($this->getTarget()['controller']))
          {
               $controller = $this->getTarget()['controller'];
          }

          if(isset($this->getTarget()['action']))
          {
              $action = $this->getTarget()['action'];
          }

          if($controller && $action)
          {
              return [$controller, $action];
          }

          return [];
      }

      /**
       * @return mixed|null
      */
      public function getMatches()
      {
          return $this->getParameter('matches');
      }


      /**
       * @return mixed
      */
      public function getPattern()
      {
          return $this->getParameter('patterns');
      }


      /**
       * @return mixed|null
      */
      public function getMiddlewares()
      {
          return $this->getParameter('middlewares');
      }


      /**
       * @param $key
       * @return mixed|null
      */
      public function getParameter($key)
      {
          return $this->route[$key] ?? null;
      }
}