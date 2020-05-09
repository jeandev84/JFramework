<?php 
namespace Framework\Database;


class Statement  extends \PDOStatement
{
	
	    public function execute($params = [])
		{
		     return parent::execute($params);
		}
}
