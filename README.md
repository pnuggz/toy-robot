Toy Robot Simulator Solution
===================

Description
-----------

- The application is a solution for the simulation of a toy robot moving on a square tabletop,
  of dimensions 5 units x 5 units.
- The solution assumes there are no obstructions on the table surface.
- The solution assumes robot is free to roam around the surface of the table, but will be
  prevented from falling to destruction. Any movement that would result in the
  robot falling from the table will be ignored, however further valid
  movement commands must still be accepted.


Installation
-----------

- This solution requires composer for the installation of phpunit as a unit tester. To download composer
  visit [website](https://getcomposer.org/)
- Once composer is installed, install the required package by running
  `composer install`
- The solution is now ready


Running the Unit Test
-----------

- To run the the unit test, simply run
  `"./vendor/bin/phpunit" main_tester.php`


Running the Solution
-----------

- There are two methods to run the solution. You can either issue commands to the robot in realtime, or
  list all the necessary steps in a text file called `command_input.txt`
- To issue commands in realtime (the default setting), run
  `php main.php`
- To issue commands from the text file, include the `-i file` input flag
  `php main.php -i`
- For a full list of commands, see below


Available Commands
-----------

- There are 5 basic commands (case insensitive)
  PLACE X,Y,F
  MOVE
  LEFT
  RIGHT
  REPORT
- `PLACE X,Y,F` will place the robot on the table at the starting position of (X,Y) in cartesian coordinates
  facing in the direction F (NORTH, EAST, SOUTH, WEST). The starting coordinates is limited to the table
  which is between 0 - 4 (inclusive) for both the X and Y coordinate. This command is required to be issued
  before any other command is received by the robot.
- `MOVE` will move the robot by 1 space in the direction it is currently facing. Should the movement cause
  the robot to fall off the table, it will disregard the command.
- `LEFT` will rotate the robot -90 degrees
  (NORTH to WEST)
  (WEST to SOUTH)
  (SOUTH to EAST)
  (EAST to NORTH)
- `RIGHT` will rotate the robot 90 degrees
  (NORTH to EAST)
  (EAST to SOUTH)
  (SOUTH to WEST)
  (WEST to NORTH)
- `REPORT` will provide a final output of the robot's current position in the following format
  `X,Y,F` where X is the location in the x-axis, Y is the location in the y-axis, and F is the direction
  the robot is facing. This will also turn off the robot and additional commands will no longer be received
  by the robot.
