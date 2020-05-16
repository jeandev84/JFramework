<?php
namespace Jan\Component\Database\ORM;


/**
 * Class Model
 * @package Jan\Component\Database\ORM
*/
class Model
{

     /** @var array  */
     protected $attributes = [];


     /** @var array  */
     protected $fillable = [];


     /** @var string[]  */
     protected $guard = ['id'];


     /** @var array  */
     protected $hidden = [];
}