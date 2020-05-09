<?php 
namespace Core\Database;


/**
 * @package QueryBuilder
 * Using Design Pattern Fluent
*/
class QueryBuilder
{

       private $fields = [];
       private $conditions  = [];
       private $from   = [];

     
	   public function select()
	   {
	   	   $this->fields = func_get_args();
           return $this;
	   }

	   public function where()
	   {
	   	   foreach(func_get_args() as $arg)
	   	   {
   	  	   	   array_push($this->conditions, $arg);
   	  	   	   // revient a $this->conditions[] = $arg;
	   	   }
           return $this;
	   }


	   public function from($table, $alias = null)
	   {
	   	   $this->from[] = is_null($alias) ? $table : "$table AS $alias";
	   	   return $this;
	   }


	   public function __toString()
	   {
	   	   return 'SELECT ' . implode(', ', $this->fields) 
	   	          .' FROM ' . implode(', ', $this->from)
	   	          .' WHERE ' . implode(' AND ', $this->conditions);
	   }
}