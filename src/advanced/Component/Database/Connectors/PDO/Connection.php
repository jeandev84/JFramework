<?php
namespace Jan\Component\Database\Connectors\PDO;


use Jan\Component\Database\Config;
use Jan\Component\Database\Contracts\ConnectionInterface;
use PDO;



/**
 * Class Connection
 * @package Jan\Component\Database\Connectors\PDO
*/
abstract class Connection implements ConnectionInterface
{

    /**
     * @var array $options  [ Default Optional params for PDO ]
     * @var array $config   [ Config array ]
    */
    private $options = [
        PDO::ATTR_PERSISTENT => true, // permit to insert data
        PDO::ATTR_EMULATE_PREPARES => 0,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ];


    /** @var  Config */
    protected $config;


    /**
     * AbstractPdoConnection constructor.
     * @param Config $config
     * @throws \Exception
     */
    public function __construct(Config $config)
    {
        if(! \in_array($driver = $config['driver'], PDO::getAvailableDrivers()))
        {
            throw new \Exception(
                sprintf('This driver (%s) is not available or unenabled!', $driver)
            );
        }

        $this->config = $config;
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
                array_merge($this->options, (array) $this->getOptions())
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
            $this->config['host'],
            $this->config['port'],
            $this->config['database'],
            $this->config['charset']
        );
    }


    /**
     * @return mixed
    */
    protected function getUsername()
    {
        return $this->config['username'];
    }

    /**
     * @return mixed
     */
    protected function getPassword()
    {
        return $this->config['password'];
    }


    /**
     * @return mixed|void
     */
    protected function getOptions()
    {
        return $this->config['options'];
    }

}