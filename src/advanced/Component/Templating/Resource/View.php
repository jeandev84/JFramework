<?php
namespace Jan\Component\Templating\Resource;


use Jan\Component\Templating\Exceptions\ViewException;


/**
 * Class View
 * @package Jan\Component\Templating\Resource
*/
class View
{


    /** @var string */
    protected $basePath;


    /** @var string */
    protected $template;


    /** @var array */
    protected $data = [];


    /** @var array  */
    protected $scripts = [];


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
     * @param $path
     * @return bool
     */
    public function loadIf($template)
    {
        return file_exists($template);
    }


    /**
     * Show script js only for content part
     * @param $content
     * @return string|string[]|null
     *
     * $content = $this->getScript(ob_get_clean());
     */
    public function getScript($content)
    {
        $pattern = "#<script.*?>.*?</script>#si";

        preg_match_all($pattern, $content, $this->scripts);

        if(! empty($this->scripts))
        {
            $content = preg_replace($pattern, '', $content);
        }

        return $content;
    }


    /**
     * @return array
     */
    public function getScripts()
    {
        return $this->scripts;
    }


    /**
     * @param $template
     * @param array $data
     * @throws ViewException
     */
    public function renderWithScript($template, $data = [])
    {
        $content = $this->render($template, $data);
        $scripts = [];

        if(! empty($this->scripts[0]))
        {
            $scripts = $this->scripts[0];
        }


        // in  template
        echo '<script src="/bootstrap/js/bootstrap.min.js"></script>';
        foreach ($scripts as $script)
        {
            echo $script ."\n";
        }
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