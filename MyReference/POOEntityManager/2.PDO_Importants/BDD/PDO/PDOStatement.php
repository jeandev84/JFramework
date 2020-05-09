<?php 

// Methods Accessible of PDO class
class PDOStatement implements \Traversable
{
      
       /* properties */
       readonly string $queryString;


       /* methodes */
	   public function bindColumn (mixed $column, mixed &$param , int $type, int $maxlen, mixed $driverdata): bool;
	   public function bindParam(mixed $parameter, mixed &$variable, int $data_type = PDO::PARAM_STR, int $length, mixed $driver_options): bool;


	   public function bindValue(mixed $parameter, mixed $value, int $data_type = PDO::PARAM_STR): bool;

	   public function closeCursor(): bool;

	   public function columnCount(): int;

	   public function debugDumpParams(): void;

	   public function errorCode(): string;

	   public function errorInfo(): array;

	   public function execute(array $input_parameters): bool;

	   public function fetch(int $fetch_style,int $cursor_orientation = PDO::FETCH_ORI_NEXT, int $cursor_offset = 0): mixed;

	   public function fetchAll(int $fetch_style, mixed $fetch_argument, array $ctor_args = []): array;


	   public function fetchColumn(int $column_number = 0): string;

	   public function fetchObject(string $class_name = "stdClass", array $ctor_args): mixed;

       public function getAttribute(int $attribute): mixed;

       public function getColumnMeta(int $column): array;

       public function nextRowset(): bool;

       public function rowCount(): int;

       public function setAttribute(int $attribure, mixed $value): bool;

       public function setFetchMode(int $mode): bool;
}