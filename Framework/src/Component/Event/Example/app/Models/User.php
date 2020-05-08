<?php
namespace App\Models;


/**
 * Class User
 * @package App\Models
*/
class User
{
    /** @var int */
    private $id;

    /** @var string */
    private $email;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return User
     */
    public function setId(int $id): User
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return User
    */
    public function setEmail(?string $email): User
    {
        $this->email = $email;
        return $this;
    }
}