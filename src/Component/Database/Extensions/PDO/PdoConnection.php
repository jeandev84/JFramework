<?php
namespace Jan\Component\Database\Extensions\PDO;


use Jan\Component\Database\Configuration;
use Jan\Component\Database\Contracts\DatabaseInterface;
use PDO;



/**
 * Class PdoConnection
 * @package Jan\Component\Database\Extensions\PDO
*/
abstract class PdoConnection implements DatabaseInterface
{

    use Configuration;


    const DEFAULT_OPTIONS = [
        PDO::ATTR_PERSISTENT => true, // permit to insert data
        PDO::ATTR_EMULATE_PREPARES => 0,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ];


    /**
     * AbstractPdoConnection constructor.
     * @throws \Exception
    */
    public function __construct()
    {
        if(! \in_array($this->driver, PDO::getAvailableDrivers()))
        {
            throw new \Exception(
                sprintf('This driver (%s) is not available or unenabled!', $this->driver)
            );
        }
    }



    /**
     * Get connection
     * @return mixed|PDO
    */
    public function connect()
    {
        try {
            $pdo = new PDO(
                $this->getDsn(),
                $this->getUsername(),
                $this->getPassword(),
                array_merge(self::DEFAULT_OPTIONS, (array) $this->getOptions())
            );

        } catch (\PDOException $exception) {

            die($exception->getMessage());
        }

        return $pdo ?? null;
    }


    /**
     * Disconnect to database
    */
    public function disconnect()
    {
        // return null;
    }



    /**
     * Get driver
     * @return string
    */
    abstract public function getDriver(): string;


    /**
     * Get current dsn
     *
     * @return string
    */
    protected function getDsn()
    {
        return sprintf('%s:host=%s;port=%s;dbname=%s;charset=%s;',
            $this->getDriver(),
            $this->host,
            $this->port,
            $this->database,
            $this->charset
        );
    }


    /**
     * @return mixed
    */
    protected function getUsername()
    {
        return $this->username;
    }

    /**
     * @return mixed
     */
    protected function getPassword()
    {
        return $this->password;
    }

    /**
     * @return mixed|void
    */
    protected function getOptions()
    {
        return $this->options;
    }

}