<?php 
namespace App\Table;

use Core\Table\Table;


class PostTable extends Table
{

	   
	   protected $table = 'articles';


	    /**
	     * Recupere les derniers articles
	     * @return array
	    */
	    public function last()
	    {
	    	  $sql = "SELECT 
	   	           articles.id, articles.title, articles.content, 
	   	           categories.title AS categorie
	   	           FROM articles 
	   	           LEFT JOIN categories 
	   	           ON category_id = categories.id
	   	           ORDER BY articles.created_at DESC";

	    	  return $this->query($sql);
	    }



       /**
        * Recuperer les articles de la categorie demandee
        * @param $category_id
        * @return array
       */
	   public function lastByCategory($category_id)
	   {
	   	   $sql = "SELECT 
	   	           articles.id, articles.title, articles.content, articles.created_at,
	   	           categories.title AS categorie
	   	           FROM articles 
	   	           LEFT JOIN categories 
	   	           ON category_id = categories.id
	   	           WHERE articles.category_id = ?
	   	           ORDER BY articles.created_at DESC";

           return $this->query($sql, [$category_id]);
	   }


        /**
         * Recupere un article en liant la categorie associe
         * @param $id int
         * @return  \App\Entity\PostEntity
        */
	    public function findWithCategory($id)
        {
             $sql = "SELECT 
	   	             articles.id, articles.title, articles.content, articles.created_at,
	   	             categories.title AS categorie
	   	             FROM articles 
	   	             LEFT JOIN categories 
	   	             ON category_id = categories.id
	   	             WHERE articles.id = ?";

            return $this->query($sql, [$id], true);
        }


}