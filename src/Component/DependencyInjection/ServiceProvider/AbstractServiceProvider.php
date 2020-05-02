<?php
namespace Jan\Component\DependencyInjection\ServiceProvider;


use Jan\Component\DependencyInjection\Contracts\ServiceProviderInterface;


/**
 * Class AbstractServiceProvider
 * @package Jan\Component\DependencyInjection\ServiceProvider
*/
abstract class AbstractServiceProvider implements ServiceProviderInterface
{

    use ServiceProviderTrait;


    /**
     * @var array
    */
    protected $provides = [];


     /**
      * @return array
     */
     public function getProvides()
     {
         return $this->provides;
     }
}