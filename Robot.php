<?php

/**
 * The Robot class
 *
 * @author Ryan Nugraha pnugraha89@gmail.com
 * @since Release 0.1.0
 */
class Robot {
  const TABLE_WIDTH = 5;
  const TABLE_HEIGHT = 5;
  const DIRECTION_DICT = [
    'north' => 0,
    'east' => 90,
    'south' => 180,
    'west' => 270
  ];

  /**
   * The maximum x position based on the tabletop width
   *
   * @var int
   */
  protected $x_max;

  /**
   * The maximum y position based on the tabletop height
   *
   * @var int
   */
  protected $y_max;

  /**
   * The curent x position of the robot
   *
   * @var int
   */
  protected $x;

  /**
   * The curent y position of the robot
   *
   * @var int
   */
  protected $y;

  /**
   * The the curent direction of the robot in degrees (between 0 - 360)
   *
   * @var int
   */
  protected $direction;

  /**
   * Indicates whether the robot has been placed on the table or not
   *
   * @var bool
   */
  protected $is_placed;

  /**
   * Indicates whether the robot is on and ready to take commands or not
   *
   * @var bool
   */
  protected $is_on;

  /**
   * Initialises the robot
   *
   * @var void
   */
  public function __construct() {
    // Set the max x position based on cartesian coordinate (x,y)
    $this->x_max = self::TABLE_WIDTH - 1;
    // Set the max y position based on cartesian coordinate (x,y)
    $this->y_max = self::TABLE_HEIGHT - 1;
    // Specifies that the robot is yet to be placed on the tabletop
    $this->is_placed = false;
    // Specifies that the robot is on and ready to receive commands
    $this->is_on = true;
  }

  /**
   * Returns a boolean whether the robot is ready to receive commands
   *
   * @var bool
   */
  public function isOn(): bool {
    return $this->is_on;
  }

  /**
   * Parses the command input, and issues an action if it matches on of the pre-defined instructions
   *
   * @var void
   */
  public function command(string $instruction = null): void {
    // Checks that the input is not null
    if (!isset($instruction)) {
      return;
    }

    // Split the input by the first space to cater for the all commands
    $instruction_array = explode(' ', trim($instruction));

    switch (trim(strtolower($instruction_array[0]))) {
      case 'place':
        // Remove the command, and only retain the required value
        unset($instruction_array[0]);
        // Join the remaining array as a string
        $placement = implode($instruction_array);
        $this->placeRobot(trim($placement) ?? null);
        break;
      case 'left':
        $this->turnLeft();
        break;
      case 'right':
        $this->turnRight();
        break;
      case 'move':
        $this->move();
        break;
      case 'report':
        $this->report();
        break;
      default:
        break;
    }
  }

  /**
   * Place the robot on the tabletop if the values are validated
   *
   * @var void
   */
  private function placeRobot(string $instruction): void {
    // Checks that the value is not null
    if (!isset($instruction)) {
      return;
    }

    // Split the value by comma delimiter
    $instructions = explode(',', $instruction);

    // Retrieve the individual values
    $x = trim($instructions[0]) ?? null;
    $y = trim($instructions[1]) ?? null;
    $direction = trim(strtolower($instructions[2])) ?? null;

    // Validate all values to ensure they are on the tabletop, and a valid direction
    $check_x = $this->checkPositionX($x);
    $check_y = $this->checkPositionY($y);
    $check_direction = $this->checkDirection($direction);

    if ($check_x && $check_y && $check_direction) {
      $this->is_placed = true;
      $this->x = $x;
      $this->y = $y;

      // Convert the text value to a degree value (between 0 - 360)
      $this->direction = self::DIRECTION_DICT[$direction];
    } else {
      // If invalid, take the robot off the table and reset the values
      $this->resetPlacement();
    }
  }

  /**
   * Validates the x coordinate input for the robot starting position is valid
   *
   * @var bool
   */
  private function checkPositionX(int $x): bool {
    return ($x >= 0 && $x <= $this->x_max);
  }

  /**
   * Validates the y coordinate input for the robot starting position is valid
   *
   * @var bool
   */
  private function checkPositionY(int $y): bool {
    return ($y >= 0 && $y <= $this->y_max);
  }

  /**
   * Validates the input direction where the robot is facing as a starting position is valid
   *
   * @var bool
   */
  private function checkDirection(string $direction): bool {
    return in_array(trim(strtolower($direction)), array_keys(self::DIRECTION_DICT));
  }

  /**
   * Take the robot off the table, and reset all values
   *
   * @var void
   */
  private function resetPlacement(): void {
    $this->x = null;
    $this->y = null;
    $this->direction = null;
    $this->is_placed = false;
  }

  /**
   * Turn -90 degrees in direction if the robot is on the table
   *
   * @var void
   */
  private function turnLeft(): void {
    // Checks that the robot is on the table
    if (!$this->isOnTable()) {
      return;
    }

    $this->direction -= 90;
    if ($this->direction < 0) {
      $this->direction = 360 + $this->direction;
    }
  }

  /**
   * Turn 90 degrees in direction if the robot is on the table
   *
   * @var void
   */
  private function turnRight(): void {
    // Checks that the robot is on the table
    if (!$this->isOnTable()) {
      return;
    }

    $this->direction += 90;
    if ($this->direction >= 360) {
      $this->direction = $this->direction - 360;
    }
  }

  /**
   * Moves the robot 1 full unit if the robot is on the table, and
   * it will not result in the robot falling off the table
   *
   * @var void
   */
  private function move(): void {
    // Checks that the robot is on the table
    if (!$this->isOnTable()) {
      return;
    }

    // Use trigonometry to get the movement value in the x-direction
    // Move EAST = sin(90) = 1
    // Move WEST = sin(270) = -1
    // Move NORTH/SOUTH = sin(0) = sin(180) = 0
    // Also ensure that the new position is validated before we move the robot
    $x = $this->x + intval(sin($this->direction * pi() / 180));
    if ($this->checkPositionX($x)) {
      $this->x = $x;
    }

    // Use trigonometry to get the movement value in the y-direction
    // Move NORTH = cos(0) = 1
    // Move SOUTH = cos(180) = -1
    // Move EAST/WEST = sin(90) = sin(270) = 0
    // Also ensure that the new position is validated before we move the robot
    $y = $this->y + intval(cos($this->direction * pi() / 180));
    if ($this->checkPositionY($y)) {
      $this->y = $y;
    }
  }

  /**
   * Turns the robot off, and provides a final out of its position and direction
   *
   * @var void
   */
  private function report(): void {
    $this->turnOff();

    if ($this->isOnTable()) {
      $direction = strtoupper(array_search($this->direction, self::DIRECTION_DICT));
      $result = "{$this->x},{$this->y},{$direction}";
      print($result);
    } else {
      print("");
    }
  }

  /**
   * Checks whether the robot has been placed on the table or not
   *
   * @var bool
   */
  private function isOnTable(): bool {
    return $this->is_placed;
  }

  /**
   * Turns the robot off so that it no longer accepts/waits for a command
   *
   * @var void
   */
  private function turnOff(): void {
    $this->is_on = false;
  }
}
