<?php
require_once 'Robot.php';

$arguments = getopt("i:");
$type = $arguments["i"] ?? "user";

$robot = new Robot();

if ($type === "file") {
  $commands = fopen("command_input.txt", "r");
  if ($commands) {
    while (($instruction = fgets($commands)) !== false) {
      $robot->command($instruction);
    }
    fclose($commands);
  }
} else {
  while ($robot->isOn()) {
    $instruction = fgets(STDIN);
    $robot->command($instruction);
  }
}
