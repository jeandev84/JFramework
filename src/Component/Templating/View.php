<?php
namespace Jan\Component\Templating;


use Jan\Component\Templating\Exceptions\ViewException;


/**
 * Class View
 * @package Jan\Component\Templating
*/
class View
{


      /** @var string */
      protected $basePath;


      /** @var string */
      protected $template;


      /** @var array */
      protected $data = [];


      /**
       * View constructor.
       * @param string $basePath
      */
      public function __construct(string $basePath)
      {
          $this->basePath = $basePath;
      }

     /**
      * @param array $data
      * @return View
     */
      public function setGlobals(array $data)
      {
           $this->data = array_merge($this->data, $data);

           return $this;
      }


      /**
       * @param $template
       * @return View
      */
      public function setPath($template)
      {
          $this->template = $template;

          return $this;
      }


      /**
       * @param ViewExtension $extension
      */
      public function addExtension(ViewExtension $extension)
      {
          //todo implements
      }

      /**
       * Render view template and optional data
       * @param string $template
       * @return false|string
       * @throws ViewException
      */
      public function renderTemplate(string $template)
      {
           extract($this->data);
           ob_start();
           require $this->resource($template);
           return ob_get_clean();
      }


      /**
       * Factory render method
       * @param string $template
       * @param array $data
       * @return false|string
       * @throws ViewException
     */
      public function render(string $template, array $data = [])
      {
           return $this->setGlobals($data)
                       ->renderTemplate($template);
      }


      /**
       * Get view file resource
       * @param string $path
       * @return string
       * @throws ViewException
      */
      public function resource(string $path)
      {
          $template = sprintf('%s%s%s',
              $this->resolvedBasePath(),
              DIRECTORY_SEPARATOR,
              $this->resolvedPath($path)
          );

          if(! file_exists($template))
          {
              throw new ViewException(
                  sprintf('Can not found view (%s) ', $template)
              );
          }

          return $template;
      }

      /**
       * Path resolver
       * @param $path
       * @return string
      */
      protected function resolvedPath($path)
      {
          return str_replace(['\\', '/'], DIRECTORY_SEPARATOR, trim($path, '\/'));
      }


     /**
      * Base path resolver
      * @return string
     */
     protected function resolvedBasePath()
     {
        return rtrim($this->basePath, '\/');
     }
}