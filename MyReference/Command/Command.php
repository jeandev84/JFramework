<?php
interface CommandInterface
{
    public function execute();
}
class TurnOnCommand implements CommandInterface
{
    /**
     * @var Lamp
     */
    protected $lamp;
    /**
     * @param Lamp $lamp
     */
    public function __construct(Lamp $lamp)
    {
        $this->lamp = $lamp;
    }
    public function execute()
    {
        $this->lamp->turnOn();
    }
}
class TurnOffCommand implements CommandInterface
{
    /**
     * @var Lamp
     */
    protected $lamp;
    /**
     * @param Lamp $lamp
     */
    public function __construct(Lamp $lamp)
    {
        $this->lamp = $lamp;
    }
    public function execute()
    {
        $this->lamp->turnOff();
    }
}
class SosCommand implements CommandInterface
{
    /**
     * @var Lamp
     */
    protected $lamp;
    /**
     * @param Lamp $lamp
     */
    public function __construct(Lamp $lamp)
    {
        $this->lamp = $lamp;
    }
    private function signal($sleep)
    {
        $this->lamp->turnOn();
        sleep($sleep);
        $this->lamp->turnOff();
        sleep($sleep);
    }
    public function execute()
    {
        while (true) {
            for ($i = 0; $i < 3; $i++) {
                $this->signal(0.1);
            }
            for ($i = 0; $i < 3; $i++) {
                $this->signal(1);
            }
        }
    }
}
class TimeoutCommand implements CommandInterface
{
    /**
     * @var Lamp
     */
    protected $lamp;
    /**
     * @var int
     */
    protected $timeout;
    /**
     * @param Lamp $lamp
     * @param int $timeout
     */
    public function __construct(Lamp $lamp, $timeout)
    {
        $this->lamp = $lamp;
        $this->timeout = $timeout;
    }
    public function execute()
    {
        $this->lamp->turnOn();
        sleep($this->timeout);
        $this->lamp->turnOff();
    }
}
class CommandRegistry
{
    /**
     * @var CommandInterface[]
     */
    private $registry = [];
    /**
     * @param string $type
     * @param CommandInterface $command
     */
    public function add(CommandInterface $command, $type)
    {
        $this->registry[$type] = $command;
    }
    /**
     * @param string $type
     * @return \CommandInterface
     * @throws RuntimeException
     */
    public function get($type)
    {
        if (!isset($this->registry[$type])) {
            throw new RuntimeException('Cannot find command ' . $type);
        }
        return $this->registry[$type];
    }
}
class Lamp
{
    public function turnOn()
    {
        echo "I'm bright and cheerful light.\n";
    }
    public function turnOff()
    {
        echo "I am quiet and peaceful shadow\n";
    }
}
$lamp = new Lamp();
$registry = new CommandRegistry();
$registry->add(new TurnOnCommand($lamp), 'ON');
$registry->add(new TurnOffCommand($lamp), 'OFF');
$registry->add(new SosCommand($lamp), 'SOS');
$registry->add(new TimeoutCommand($lamp, $argv[2]), 'TIMEOUT');
$registry->get($argv[1])->execute();