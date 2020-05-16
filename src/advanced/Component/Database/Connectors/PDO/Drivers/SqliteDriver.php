<?php
namespace Jan\Component\Database\Connectors\PDO\Drivers;


use Jan\Component\Database\Connectors\PDO\Connection;


/**
 * Class SqliteDriver
 * @package Jan\Component\Database\Connectors\PDO\Drivers
 *
 * SQLite connection via PDO
*/
class SqliteDriver extends Connection
{

    /**
     * @return string
    */
    public function getDriver(): string
    {
        return 'sqlite';
    }


    /**
     * @return string
    */
    protected function getDsn(): string
    {
        return sprintf('%s:%s',
          $this->getDriver(),
          $this->config['database']
        );
    }


    /**
     * @return mixed|null
    */
    protected function getUsername()
    {
        return null;
    }

    /**
     * @return mixed|null
    */
    protected function getPassword()
    {
        return null;
    }

    /**
     * @return array|mixed
    */
    protected function getOptions()
    {
        return [];
    }
}