<?php 

class CommandRegistry {
    private $registry = [];
    public function add(CommandInterface $command, $type) {
        $this->registry[$type] = $command;
    }
    public function get($type) {
        if (!isset($this->registry[$type])) {
            throw new RuntimeException('Cannot find command ' . $type);
        }
        return $this->registry[$type];
    }
}