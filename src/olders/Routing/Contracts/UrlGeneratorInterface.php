<?php
namespace Jan\Component\Routing\Contracts;


/**
 * Interface UrlGeneratorInterface
 * @package Jan\Component\Routing\Contracts
*/
interface UrlGeneratorInterface
{
     /**
       * Generate URL
       *
       * @param $path
       * @param array $params
       * @return mixed
     */
     public function generate($path, $params = []);
}