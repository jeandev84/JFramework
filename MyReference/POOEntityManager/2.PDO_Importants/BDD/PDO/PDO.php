<?php 

// Methods Accessible of PDO class
class PDO
{

	   public function __construct(string $dsn, string $username, string $password, array $driver_options);
	  
	   public function beginTransaction(): bool;
	   public function commit(): bool;

	   public function errorCode(): mixed;

	   public function errorInfo(): array;

	   public function exec(string $statement): int;

	   public function getAttribute(): mixed;

	   public static function getAvailableDrivers(): array;
       
       public function inTransaction(): bool;

	   public function lastInsertId(string $name = NULL): string;

	   public function prepare(string $statement , array $driver_options = []): PDOStatement;

	   public function query(string $statement): PDOStatement;

	   public function quote(string $string, int $parameter_type = PDO::PARAM_STR);

	   public function rollBack(): bool;

	   public function setAttribute(int $attribute, mixed $value): bool;
}