<?php
namespace App\Services;


use App\Entity\Model\User;

/**
 * Class EmailSender
 * @package App\Services
*/
class EmailSender
{
    /**
     * EmailSender constructor.
     * @param User $user
     * @param mixed ...$options
    */
    public function __construct(User $user, ...$options)
    {
         // for example
    }

    public function send() {}
}