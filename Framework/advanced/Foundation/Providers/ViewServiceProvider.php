<?php
namespace Jan\Foundation\Providers;


use Jan\Component\DependencyInjection\Contracts\BootableServiceProvider;
use Jan\Component\DependencyInjection\ServiceProvider\AbstractServiceProvider;
use Jan\Component\Templating\View;



/**
 * Class ViewServiceProvider
 * @package Jan\Foundation\Providers
*/
class ViewServiceProvider extends AbstractServiceProvider
{

    /**
     * @return mixed
    */
    public function register()
    {
        $this->container->singleton('view', function () {

            return new View($this->container->get('base.path').'/templates/views/');
        });
    }

}