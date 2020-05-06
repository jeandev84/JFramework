<?php
namespace Jan\Component\Database;


//use Jan\Component\Database\Extensions\PDO\Drivers\{
//    Mysql,
//    Sqlite,
//    Pgsql,
//    Oracle
//};



/**
 * Class ConnectionStack
 * @package Jan\Component\Database
*/
class ConnectionStack
{

    /**
     * @return string[]
     * @throws \Exception
    */
    public static function storage()
    {
       return [
          new Mysql(),
          new Sqlite(),
          new Pgsql(),
          new Oracle()
       ];
    }
}