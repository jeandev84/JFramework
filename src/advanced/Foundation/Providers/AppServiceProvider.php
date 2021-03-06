<?php
namespace Jan\Foundation\Providers;


use Jan\Component\DI\Contracts\BootableServiceProvider;
use Jan\Component\DI\Contracts\ContainerInterface;
use Jan\Component\DI\ServiceProvider\AbstractServiceProvider;
use Jan\Component\Dotenv\Env;
use Jan\Component\Http\Message\RequestInterface;
use Jan\Component\Http\Message\ResponseInterface;
use Jan\Component\Http\Request;
use Jan\Component\Http\Response;


/**
 * Class AppServiceProvider
 * @package Jan\Foundation\Providers
*/
class AppServiceProvider extends AbstractServiceProvider implements BootableServiceProvider
{
    /**
     * @return mixed
    */
    public function boot()
    {
        $this->loadHelpers();
        $this->loadEnvironments();
    }


    /**
     * @return mixed
    */
    public function register()
    {
        $this->container->singleton(ContainerInterface::class, function () {
            return $this->container;
        });


        // Bind Request interface
        $this->container->singleton(RequestInterface::class, function () {
            return new Request();
        });

        // Bind Response interface
        $this->container->singleton(ResponseInterface::class, function () {
            return new Response();
        });
    }



    /**
     * Load environment variables
     */
    protected function loadEnvironments()
    {
        try {

            $dotenv = (new Env($this->container->get('base.path')))
                ->load();

        } catch (\Exception $e) {
            exit($e->getMessage());
        }
    }


    /**
     * Load helpers
     */
    protected function loadHelpers()
    {
        require __DIR__.'/../helpers.php';
    }

}