<?php
namespace App\Entity;


/**
 * Class User
 * @package App\Entity
*/
class User
{

    /** @var int */
    private $id;


    /** @var string */
    private $name;


    /** @var string */
    private $email;


    /** @var string */
    private $address;


    /** @var string */
    private $role;


    /**
     * User constructor.
    */
    public function __construct()
    {
        // instance collections data
    }

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
    public function getName(): string
    {
        return $this->name;
    }


    /**
     * @param string $name
     * @return User
    */
    public function setName(string $name): User
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
    */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return User
    */
    public function setEmail(string $email): User
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string
    */
    public function getAddress(): string
    {
        return $this->address;
    }

    /**
     * @param string $address
     * @return User
    */
    public function setAddress(string $address): User
    {
        $this->address = $address;
        return $this;
    }

    /**
     * @return string
    */
    public function getRole(): string
    {
        return $this->role;
    }

    /**
     * @param string $role
     * @return User
    */
    public function setRole(string $role): User
    {
        $this->role = $role;
        return $this;
    }

}