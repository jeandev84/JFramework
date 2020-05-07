<?php
namespace Jan\Component\Database\ORM;


use Jan\Component\Database\Contracts\EntityManagerInterface;
use Jan\Component\Database\Contracts\QueryManagerInterface;

/**
 * Class EntityManager
 * @package Jan\Component\Database\ORM
*/
class EntityManager implements EntityManagerInterface
{


    /** @var string */
    protected $entityMapped;


    /** @var object */
    protected $entityObject;



    /** @var array  */
    protected $properties = [];



    /** @var array  */
    protected $fills = [];



    /** @var QueryManagerInterface  */
    protected $manager;



    /**
     * EntityManager constructor.
     * @param QueryManagerInterface $manager
    */
    public function __construct(QueryManagerInterface $manager)
    {
           $this->manager = $manager;
    }



    /**
     * @param object $entityObject
    */
    public function persist(object $entityObject)
    {
        $reflectedObject = new \ReflectionObject($entityObject);
        $this->entityMapped = $reflectedObject->getName();

        foreach($reflectedObject->getProperties() as $property)
        {
             $property->setAccessible(true);
             $this->properties[] = $property->getName();
             $this->fills[$property->getName()] = $property->getValue($entityObject);
        }

        $this->entityObject = $entityObject;
    }


    public function delete(object $object)
    {
          //
    }


    /**
     *
    */
    public function flush()
    {
         // save to the database

         dump($this->properties, $this->fills);

         if($this->isNewRecord())
         {
             $this->update();

         } else{

             $this->insert();
         }
    }


    protected function insert()
    {
         dump('Insert data');
    }


    protected function update()
    {
        dump('Update data');
    }


    /**
     * Determine if has new record
     * @return bool
     */
    protected function isNewRecord()
    {
        return property_exists($this->entityObject, 'id') && isset($this->fills['id']);
    }

}