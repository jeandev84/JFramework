<?php
namespace App\Entity;


/**
 * Class Brand
 * @package App\Entity
*/
class Brand
{

    /** @var int */
    private $id;


    /** @var string */
    private $title;

    /**
     * @return int
     */
    public function getId(): int
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
     * @return Brand
     */
    public function setTitle(string $title): Brand
    {
        $this->title = $title;
        return $this;
    }

}