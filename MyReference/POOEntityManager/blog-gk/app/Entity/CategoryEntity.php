<?php 
namespace App\Entity;

use Core\Entity\Entity;


class CategoryEntity  extends Entity
{
      
       /**
        * Get URL
       */
	   public function getURL()
	   {
	   	  return 'index.php?p=posts.category&id=' . $this->id;
	   }
 
}