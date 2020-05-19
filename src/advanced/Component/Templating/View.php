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
          $this->setBasePath($basePath);
      }


      /**
       * @param string $basePath
       * @return $this
      */
      public function setBasePath(string $basePath)
      {
          $this->basePath = $basePath;

          return $this;
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
          //TODO implements
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
       * @param array $vars
       * @return false|string
       * @throws ViewException
      */
      public function render(string $template, array $vars = [])
      {
           return $this->setGlobals($vars)->renderTemplate($template);
      }


      /**
       * Get view file resource
       * @param string $path
       * @return string
       * @throws ViewException
      */
      public function resource(string $path)
      {
          $template = $this->resourcePath($path);

          if(! $this->loadIf($template))
          {
              throw new ViewException(sprintf('Can not found view (%s) ', $template), 404);
          }

          return $template;
      }


      /**
       * @param $path
       * @return string
      */
      public function resourcePath($path)
      {
          return sprintf('%s%s%s',
              $this->resolvedBasePath(),
              DIRECTORY_SEPARATOR,
              $this->resolvedPath($path)
          );
      }


      /**
       * @param string $template
       * @return bool
      */
      public function loadIf(string $template)
      {
          return file_exists($template);
      }


      /**
       * Path resolver
       * @param string $path
       * @return string
      */
      protected function resolvedPath(string $path)
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