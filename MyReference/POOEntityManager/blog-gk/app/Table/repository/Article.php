<?php 
namespace App\Table;


use App\App;


class Article extends Table
{

       
       protected static $table = 'articles';


        public static function find($id)
        {
             $sql = "SELECT 
	   	             articles.id, articles.title, articles.content, 
	   	             categories.title AS categorie
	   	             FROM articles 
	   	             LEFT JOIN categories 
	   	             ON category_id = categories.id
	   	             WHERE articles.id = ?";

            return self::query($sql, [$id], true);
        }
       
       /**
        * Recuperer les derniers articles
        * La methode query() se trouve dans la classe parente Table
       */
	   public static function getLast()
	   {
	   	   $sql = "SELECT 
	   	           articles.id, articles.title, articles.content, 
	   	           categories.title AS categorie
	   	           FROM articles 
	   	           LEFT JOIN categories 
	   	           ON category_id = categories.id
	   	           ORDER BY articles.created_at DESC";

           return self::query($sql);
	   }

	   /**
        * Recuperer les articles par categorie
        * @param $category_id
       */
	   public static function lastByCategory($category_id)
	   {
	   	   $sql = "SELECT 
	   	           articles.id, articles.title, articles.content, 
	   	           categories.title AS categorie
	   	           FROM articles 
	   	           LEFT JOIN categories 
	   	           ON category_id = categories.id
	   	           WHERE category_id = ?
	   	           ORDER BY articles.created_at DESC";

           return self::query($sql, [$category_id]);
	   }
       
       /**
        * Get URL
       */
	   public function getURL()
	   {
	   	  return 'index.php?p=article&id=' . $this->id;
	   }

	   public function getExtrait()
	   {
	   	  $html  = '<p>'. substr($this->content, 0, 100) .'...</p>';
	   	  $html .= '<p><a href="'. $this->getURL() .'">Voir la suite</a></p>';
	   	  return $html;
	   }
}