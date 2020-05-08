<?php
namespace Jan\Component\Routing;


use Jan\Component\Database\Contracts\QueryManagerInterface;
use Jan\Component\DependencyInjection\Contracts\ContainerInterface;
use Jan\Component\Http\Message\ResponseInterface;
use Jan\Component\Http\Response;
use Jan\Component\Templating\View;

/**
 * Class Controller
 * @package Jan\Component\Routing
*/
abstract class Controller
{

      /** @var ContainerInterface  */
      protected $container;


      /** @var string */
      protected $layout = 'default';


     /**
      * Controller constructor.
     */
      public function __construct()
      {

      }


      /**
       * @param string $template
       * @param array $data
       * @param Response|null $response
       * @return Response
      */
      protected function render(string $template, array $data = [], Response $response = null): Response
      {
           $response = $this->container->get(ResponseInterface::class);
           $view = $this->container->get('view');

           $content = $view->render($template, $data);

           ob_start();
           if($this->layout !== false)
           {
               require $view->resource('layouts/'. $this->layout .'.php');
           }
           $content = ob_get_clean();

           $response->withBody($content);

           return $response;
      }


     /**
      * @param $key
      * @return mixed
     */
     protected function getParameter($key)
     {
          return $this->container->get($key);
     }


    /**
     * @param ContainerInterface $container
    */
    public function setContainer(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @return ContainerInterface
    */
    public function getContainer()
    {
        return $this->container;
    }


    /**
     * @return mixed
    */
    public function getManager()
    {
        return $this->container->get(QueryManagerInterface::class);
    }

}