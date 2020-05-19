<?php
namespace App\Entity;


use Jan\Component\Database\ORM\Model;
use Jan\Component\Helpers\Collections\ArrayCollection;


/**
 * Class User
 * @package App\Entity
*/
class User
{

    /**
     * @var string
    */
    //private $table = 'users';


    /** @var int */
    private $id;


    /** @var string */
    private $name;


    /** @var string */
    private $password;


    /** @var string */
    private $email;


    /** @var string */
    private $address;


    /** @var string */
    private $role;


    /** @var array  */
    // private $posts = [];


    /** @var  */
    private $deleted_at;


    /**
     * User constructor.
    */
    public function __construct()
    {
        // instance collections data
        // always it will setted 0
        $this->deleted_at = 0;
        $this->role = 'user';

        /* $this->posts = new ArrayCollection(); */
    }


    /**
     * @return null|int
    */
    public function getId(): ?int
    {
        return $this->id;
    }


    // just for testing something
    // in realtime we don't need to set id
    // because id autoincremented generally
    public function setId(?int $id)
    {
        $this->id = $id;

        return $this;
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


    /**
     * @param $deletedAt
     * @return $this
    */
    public function setDeletedAt($deletedAt)
    {
        $this->deleted_at = $deletedAt;

        return $this;
    }


    /**
     * @return null
    */
    public function getDeletedAt()
    {
        return $this->deleted_at;
    }


    /**
     * @param Post $post
     * @return User
    */
//    public function addPost(Post $post)
//    {
//         if(! \in_array($post, $this->posts))
//         {
//             $this->posts[] = $post;
//             $post->addUser($this);
//         }
//
//         return $this;
//
//         /*
//         if(! $this->posts->contains($post))
//         {
//             $this->posts[] = $post;
//             $post->addUser($this);
//         }
//         return $this;
//        */
//    }
//
//
//    /**
//     * @return array
//    */
//    public function getPosts()
//    {
//        return $this->posts;
//    }


}