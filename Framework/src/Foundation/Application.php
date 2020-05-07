<?php
namespace Jan\Foundation;


use Jan\Foundation\Providers\AppServiceProvider;
use Jan\Foundation\Providers\DatabaseServiceProvider;
use Jan\Foundation\Providers\MiddlewareServiceProvider;
use Jan\Foundation\Providers\RouteServiceProvider;
use Jan\Foundation\Providers\ViewServiceProvider;
use Jan\Component\DependencyInjection\Container;


/**
 * Class Application
 * @package Jan\Foundation
 *
 * Application  :  JFramework
 * Author       :  Jean-Claude <jeanyao@mail.com>
 */
class Application extends Container
{

    /**
     * The Jan framework version.
     */
    const VERSION = '1.0.0';


    /**
     * The base path for Jan installation
     *
     * @var string
     */
    protected $basePath;


    /**
     * Create a new application instance.
     *
     * Application constructor.
     * @param string $basePath
     * @return void
     * @throws \ReflectionException
    */
    public function __construct(string $basePath = null)
    {
        if ($basePath) {
            $this->setBasePath($basePath);
        }

        $this->loadHelpers();
        $this->registerBaseBindings();
        $this->registerBaseServiceProviders();
        $this->registerCoreContainerAliases();
    }


    /**
     * Get the version number of application.
     *
     * @return string
     */
    public function version()
    {
        return self::VERSION;
    }


    /**
     * Set the base path for the application.
     *
     * @param string $basePath
     * @return $this
     */
    public function setBasePath(string $basePath)
    {
        if ($basePath) {
            $this->basePath = rtrim($basePath, '\/');
        }

        $this->bindPathsInContainer();
        return $this;
    }


    /**
     * Bind all of the application paths in the container
     *
     * @return void
     */
    protected function bindPathsInContainer()
    {
        $this->bind('base.path', $this->basePath());
    }


    /**
     * Get Base path of application
     * @param string $path
     * @return string
     */
    public function basePath($path = '')
    {
        return $this->basePath . ($path ? DIRECTORY_SEPARATOR . $path : $path);
    }


    /**
     * Throw an HttpException with the given data.
     *
     *
     * @param int $code
     * @param string $message
     * @param array $headers
     * @throws // \HttpException
     * @throws // NotFoundHttpException
    */
    public function abort($code, $message = '', $headers = [])
    {
        if ($code == 404) {
            // throw new NotFoundHttpException($message);
        }

    }

    /**
     * Flush the container of all bindings and resolved instances
     *
     * @return void
     */
    public function flush()
    {
        //
    }


    /**
     * @return void
     */
    protected function loadHelpers()
    {
        require_once __DIR__ . '/helpers.php';
    }


    /**
     * Register the basic info the container.
     *
     * @return void
     */
    protected function registerBaseBindings()
    {
        $this->bind('app', $this);
        $this->bind(Container::class, $this);
    }


    /**
     * Register all of the base service providers
     *
     * @return void
     * @throws \ReflectionException
     */
    protected function registerBaseServiceProviders()
    {
        $this->addServiceProvider(AppServiceProvider::class);
        $this->addServiceProvider(RouteServiceProvider::class);
        $this->addServiceProvider(DatabaseServiceProvider::class);
        $this->addServiceProvider(MiddlewareServiceProvider::class);

        // last to load
        $this->addServiceProvider(ViewServiceProvider::class);
    }


    /**
     * Register the core class aliases int the container
     *
     * @return void
     */
    protected function registerCoreContainerAliases()
    {
        //
    }

}