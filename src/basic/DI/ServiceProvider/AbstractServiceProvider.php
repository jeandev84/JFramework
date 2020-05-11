<?php
namespace Jan\DI\ServiceProvider;


use Jan\DI\Contracts\ServiceProviderInterface;


/**
 * Class AbstractServiceProvider
 * @package Jan\DI\ServiceProvider
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