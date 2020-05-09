<?php 

class LampCommandFactory
{
    public function factory($type, Lamp $lamp)
    {
        if ($type == 'ON') {
            return new TurnOnCommand($lamp);
        }
        if ($type == 'OFF') {
            return new TurnOffCommand($lamp);
        }
        throw new RuntimeException('Cannot find command ' . $type);
    }
}
