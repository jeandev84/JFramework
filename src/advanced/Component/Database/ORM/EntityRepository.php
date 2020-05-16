<?php
namespace Jan\Component\Database\ORM;


use Jan\Component\Database\Contracts\ManagerInterface;


/**
 * Class EntityRepository
 * @package Jan\Component\Database\ORM
*/
class EntityRepository
{

      /** @var ManagerInterface */
      protected $manager;


      /** @var  */
      protected $entityClass;


      /**
       * EntityRepository constructor.
       * @param ManagerInterface $manager
       * @param string $entityClass
      */
      public function __construct(ManagerInterface $manager, $entityClass)
      {
          $this->manager = $manager;
          $this->manager->withEntityClass($entityClass);
          $this->entityClass = $entityClass;
      }


      /**
       * @return mixed
      */
      public function getConnection()
      {
          return $this->manager->getConnection();
      }


      /**
       * @return string
       * @throws \ReflectionException
      */
      protected function tableName()
      {
         $reflectedClass = new \ReflectionClass($this->entityClass);
         return mb_strtolower($reflectedClass->getShortName()).'s';
      }
}