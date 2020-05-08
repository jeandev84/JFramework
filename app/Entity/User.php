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
    private $firstname;


    /** @var string */
    private $lastname;


    /** @var string */
    private $email;


    /** @var string */
    private $password;


    /** @var string */
    private $mobile;


    /** @var string */
    private $address1;



    /** @var string */
    private $address2;


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
    public function getFirstname(): string
    {
        return $this->firstname;
    }

    /**
     * @param string $firstname
     * @return User
     */
    public function setFirstname(string $firstname): User
    {
        $this->firstname = $firstname;
        return $this;
    }

    /**
     * @return string
     */
    public function getLastname(): string
    {
        return $this->lastname;
    }

    /**
     * @param string $lastname
     * @return User
     */
    public function setLastname(string $lastname): User
    {
        $this->lastname = $lastname;
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
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     * @return User
     */
    public function setPassword(string $password): User
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @return string
     */
    public function getMobile(): string
    {
        return $this->mobile;
    }

    /**
     * @param string $mobile
     * @return User
     */
    public function setMobile(string $mobile): User
    {
        $this->mobile = $mobile;
        return $this;
    }

    /**
     * @return string
     */
    public function getAddress1(): string
    {
        return $this->address1;
    }

    /**
     * @param string $address1
     * @return User
     */
    public function setAddress1(string $address1): User
    {
        $this->address1 = $address1;
        return $this;
    }

    /**
     * @return string
     */
    public function getAddress2(): string
    {
        return $this->address2;
    }

    /**
     * @param string $address2
     * @return User
     */
    public function setAddress2(string $address2): User
    {
        $this->address2 = $address2;
        return $this;
    }

}