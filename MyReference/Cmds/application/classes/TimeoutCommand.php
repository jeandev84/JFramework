<?php 

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
