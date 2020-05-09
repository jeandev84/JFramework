<?php 

class TurnOnCommand implements CommandInterface {
    protected $lamp;
    public function __construct(Lamp $lamp) {
        $this->lamp = $lamp;
    }
    public function execute() {
        $this->lamp->turnOn();
    }
}
