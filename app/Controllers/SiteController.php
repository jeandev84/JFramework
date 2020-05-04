<?php
namespace App\Controllers;


use App\Entity\User;

/**
 * Class SiteController
 * @package App\Controllers
 */
class SiteController
{
      public function __construct(User $user)
      {
          echo __METHOD__."<br>";
      }

      public function index()
      {
          echo "Welcome to my website! <br>";
      }
}