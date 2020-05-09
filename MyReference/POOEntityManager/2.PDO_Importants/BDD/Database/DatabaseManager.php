<?php 
namespace Framework\Database;


class DatabaseManager
{
        
        private $connection;

        
	    public function __construct(DatabaseConnection $connection)
	    {
	    	 if(!$this->connection)
	    	 {
	    	 	 $this->connection = $connection->make();
	    	 }

	    	 return $this->connection;
	    }
		
		
		public function query(string $sql): \Statement
        {
             return $this->connection->query($sql);
        }


        public function prepare(string $sql): \Statement
        {
             return $this->connection->prepare($sql);
        }
		
		
		public function beginTransaction()
		{
			 return $this->connection->beginTransaction();
		}
		
		
		public function rollBack()
		{
			 return $this->connection->rollBack();
		}
		
		
		public function commit()
		{
			 return $this->connection->commit();
		}
		
		
		public function execute(\Statement $stmt, $params = [])
		{
			return $stmt->execute($params);
		}

       
}