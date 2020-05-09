<?php 
namespace App\Table;



class Categories  extends Table
{
 
       
       protected static $table = 'categories';

        
       /**
        * Get URL
       */
	   public function getURL()
	   {
	   	   return 'index.php?p=categorie&id=' . $this->id;
	   }
}