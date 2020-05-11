<?php
namespace Jan\Component\Routing;


use Jan\Component\Database\Contracts\QueryManagerInterface;
use Jan\Component\DependencyInjection\Contracts\ContainerInterface;
use Jan\Component\Http\Message\ResponseInterface;
use Jan\Component\Http\Response;
use Jan\Component\Templating\Exceptions\ViewException;
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


      /** @var View */
      private $view;


      /**
       * Controller constructor.
       * @param ContainerInterface $container
      */
      public function __construct(ContainerInterface $container)
      {
           $this->container = $container;
           $this->view = $this->container->get('view');
      }


     /**
       * @param string $template
       * @param array $data
       * @return
       * @throws ViewException
     */
      protected function renderTemplate(string $template, array $data = [])
      {
          return $this->view->render($template, $data);
      }


     /**
      * @param string $template
      * @param array $data
      * @param Response|null $response
      * @return Response
      * @throws ViewException
     */
      protected function render(string $template, array $data = [], Response $response = null): Response
      {
           $response = $this->container->get(ResponseInterface::class);
           $content = $this->renderTemplate($template, $data);

           ob_start();
           if($this->layout !== false)
           {
               require $this->view->resource('layouts/'. $this->layout .'.php');
               $content = ob_get_clean();
           }

           $response->withBody($content);

           return $response;
      }


      /**
       * @param array $data
       * @param int $status
       * @return Response
       *
       * TODO Refactoring
      */
      protected function json(array $data, $status = 200)
      {
          $response = $this->container->get(ResponseInterface::class);
          return $response->withStatus($status)
                          ->withJson($data);
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