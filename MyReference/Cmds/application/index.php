<?php 

/** Designs Patterns 
  http://dron.by/post/pattern_proektirovaniya_command_komanda_na_php.html
**/

/**
 Dispatcher 

 CommandInterface
  + execute()

 Receiver 
  + action()

 ConcreteCommand
  + execute

 **/

require_once 'autoload.php';

$lamp = new Lamp();
$registry = new CommandRegistry();
$registry->add(new TurnOnCommand($lamp), 'ON');
$registry->add(new TurnOffCommand($lamp), 'OFF');
$registry->add(new SosCommand($lamp), 'SOS');
$registry->add(new TimeoutCommand($lamp, $argv[2]), 'TIMEOUT');
$registry->get($argv[1])->execute();