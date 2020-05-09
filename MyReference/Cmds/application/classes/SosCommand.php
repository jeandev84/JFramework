<?php 

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
