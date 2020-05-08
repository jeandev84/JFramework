<?php
namespace App\Entity;


/**
 * Class Category
 * @package App\Entity
*/
class Category
{

     /** @var string */
     public $id;


     /** @var string */
     public $title;


    /**
     * @return string
    */
    public function getId(): string
    {
        return $this->id;
    }


    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return Category
     */
    public function setTitle(string $title): Category
    {
        $this->title = $title;
        return $this;
    }

}