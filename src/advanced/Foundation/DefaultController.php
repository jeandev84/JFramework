<?php
namespace Jan\Foundation;


use Jan\Component\DependencyInjection\Contracts\ContainerInterface;
use Jan\Component\Routing\Controller;
use Jan\Component\Templating\View;


/**
 * Class DefaultController
 * @package Jan\Foundation
*/
class DefaultController extends  Controller
{

     /** @var View */
     protected $view;


     /** @var bool  */
     protected $layout = false;



    /**
     * DefaultController constructor.
     * @param ContainerInterface $container
     */
     public function __construct(ContainerInterface $container)
     {
         parent::__construct($container);
         $this->view = $container->get('view');
         $this->view->setBasePath(__DIR__.'/Resources/views');
     }


     /**
      * Action index
     */
     public function index()
     {
         return $this->render('welcome.php');
     }
}