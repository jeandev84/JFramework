<?php
namespace Jan\Component\Routing;


use Jan\Component\Routing\Contracts\UrlGeneratorInterface;



/**
 * Class UrlGenerator
 * @package Jan\Component\Routing
*/
class UrlGenerator implements UrlGeneratorInterface
{


     /** @var  */
     protected $host;


     /**
      * Url constructor.
      * @param string $host
     */
     public function __construct(string $host = '')
     {
          $this->host = $host;
     }


      /**
       * Generate URI
       *
       * @param string $path
       * @param array $params
       * @return bool|mixed
      */
      public function generate($path, $params = [])
      {
          if(! Route::hasNamed($path))
          {
              if($params)
              {
                  return $this->build($path .'?'. http_build_query($params));
              }

              return $this->build($path);
          }

          return $this->build(Route::generate($path, $params));
      }


      /**
       * @param $uri
       * @return string
      */
      protected function build($uri)
      {
          return $this->host.'/'. ltrim($uri, '/');
      }
}