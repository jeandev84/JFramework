<?php
namespace Jan\Component\Templating;


use Jan\Component\Templating\Exceptions\ViewException;


/**
 * Class ScriptResolver
 * @package Jan\Component\Templating
*/
class ScriptResolver
{

    /** @var array  */
    protected $scripts = [];


    /**
     * Show script js only for content part
     * @param $content
     * @return string|string[]|null
     *
     * $content = $this->resolve(ob_get_clean());
     */
    public function resolve($content)
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
        $content = $this->resolve(
            $this->render($template, $data)
        );

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
     * @param $template
     * @param array $data
     * @return false|string
    */
    public function render($template, $data = [])
    {
        extract($data);
        ob_start();
        require $template;
        return ob_get_clean();
    }

}