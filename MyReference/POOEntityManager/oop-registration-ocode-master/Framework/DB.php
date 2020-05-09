<?php 
namespace Project;

use \PDO;


class DB
{
	
		 private static $instance = null;
	     private $pdo,
	             $query,
	             $error = false,
	             $results,
	             $count = 0;


          private function __construct()
          {
          	  try 
          	  {
                  $this->pdo = new PDO(
                  	       $this->getDSN(), 
                  	       Config::get('mysql/username'),
                  	       Config::get('mysql/password'), 
                           Config::get('mysql/options') 
                  );

                  // echo 'Connected!';

          	  }catch(\PDOException $e){

          	  	 die($e->getMessage());
          	  }
          }


	       public static function getInstance()
	       {
              if(!isset(self::$instance))
              {
                 self::$instance = new DB();
              }

              return self::$instance;
	       }




	      private function getDSN()
	      {
	      	   return sprintf('mysql:host=%s;dbname=%s;charset=utf8', Config::get('mysql/host'), Config::get('mysql/db'));
	      }

        /**
         * DB::getInstance()->query('SELECT username FROM users WHERE username = ?', ['username' => 'jean']);
        */
        public function query($sql, $params = [])
        {
              $this->error = false;
  
              if($this->query = $this->pdo->prepare($sql))
              {
                   $x = 1;
                   if(count($params))
                   {
                      foreach($params as $param)
                      {
                          # bind value [1, 2, 3 ....]
                          $this->query->bindValue($x, $param);
                          $x++;
                      }
                   }

                   if($this->query->execute())
                   {
                       // echo 'Success!';

                       $this->results = $this->query->fetchAll(PDO::FETCH_OBJ);
                       $this->count   = $this->query->rowCount();

                   }else {

                       $this->error = true;
                   }
              }

              return $this;
        }


        public function action($action, $table, $where = [])
        {
             # $action peut etre [SELECT, INSERT, UPDATE, DELETE]
             if(count($where) === 3)
             {
                  $operators = ['=', '>', '<', '>=', '<='];

                  $field    = $where[0];
                  $operator = $where[1];
                  $value    = $where[2];


                  if(in_array($operator, $operators))
                  {
                       $sql = "{$action} FROM {$table} WHERE {$field} {$operator} ?";

                       if(!$this->query($sql, [$value])->error()) 
                       {
                            # if the query successfully , we'll return current object
                            # pour faire le chainage
                            return $this;
                       }
                  }
             }

             return false;

        }


        public function get($table, $where)
        {
            return $this->action('SELECT *', $table, $where);
        }

        public function delete($table, $where)
        {
             return $this->action('DELETE', $table, $where);
        }
        
        # INSERT INTO users (`username`, `password`, `salt`) VALUES (?, ?, ?)
        public function insert($table, $fields = [])
        {
                $keys = array_keys($fields);
                $values = '';
                $x =1;

                foreach($fields as $field)
                {
                    $values .= '?';
                    
                    if($x < count($fields))
                    {
                        $values .= ', ';
                    }
                    $x++;
                }

                $sql = "INSERT INTO {$table} (`" . implode('`, `', $keys) . "`) VALUES ({$values})";
                
                // die($sql);

                if(!$this->query($sql, $fields)->error())
                {
                     return true;

                }

               return false;
        }

        public function update($table, $id, $fields)
        {
             $set = '';
             $x = 1;

             foreach($fields as $name => $value)
             {
                   $set .= "{$name} = ?";

                   if($x < count($fields))
                   {
                       $set .= ', ';
                   }
                   $x++;
             }
             

             $sql = "UPDATE {$table} SET {$set} WHERE id = {$id}";

             if(!$this->query($sql, $fields)->error())
             {
                  return true;
             }

             return false;
        }

        public function results()
        {
             return $this->results;
        }

        public function first()
        {
             return $this->results()[0];
        }

        public function error()
        {
            return $this->error;
        }


        public function count()
        {
            return $this->count;
        }

}