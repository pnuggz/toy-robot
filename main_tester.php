<?php declare (strict_types = 1);
use PHPUnit\Framework\TestCase;

final class main_tester extends TestCase {
  public function setUp(): void {
    require_once 'Robot.php';
    $this->robot = new Robot();
  }

  public function testNoPlacement() {
    $expected = '';

    $this->robot->command('MOVE');
    $this->robot->command('MOVE');
    $this->robot->command('LEFT');
    $this->robot->command('MOVE');
    $this->robot->command('RIGHT');
    $this->robot->command('RIGHT');
    $this->robot->command('MOVE');
    $actual = $this->robot->command('REPORT');

    $this->expectOutputString($expected);
  }

  public function testPlacement() {
    $expected = '0,0,NORTH';

    $this->robot->command('PLACE 0,0,NORTH');
    $actual = $this->robot->command('REPORT');

    $this->expectOutputString($expected);
  }

  public function testPlacementXOutOfRange() {
    $expected = '';

    $this->robot->command('PLACE 6,0,NORTH');
    $actual = $this->robot->command('REPORT');

    $this->expectOutputString($expected);
  }

  public function testPlacementYOutOfRange() {
    $expected = '';

    $this->robot->command('PLACE 0,-6,NORTH');
    $actual = $this->robot->command('REPORT');

    $this->expectOutputString($expected);
  }

  public function testPlacementAfterPlacement() {
    $expected = '2,2,SOUTH';

    $this->robot->command('PLACE 0,0,NORTH');
    $this->robot->command('MOVE');
    $this->robot->command('RIGHT');
    $this->robot->command('PLACE 2,3,SOUTH');
    $this->robot->command('MOVE');
    $actual = $this->robot->command('REPORT');

    $this->expectOutputString($expected);
  }

  public function testPlacementOutOfRangeThenInRange() {
    $expected = '2,3,SOUTH';

    $this->robot->command('PLACE 0,-6,NORTH');
    $this->robot->command('PLACE 2,3,SOUTH');
    $actual = $this->robot->command('REPORT');

    $this->expectOutputString($expected);
  }

  public function testPlacementDirectionUnknown() {
    $expected = '';

    $this->robot->command('PLACE 0,-6,NORT');
    $actual = $this->robot->command('REPORT');

    $this->expectOutputString($expected);
  }

  public function testPlacementIncorrectFormatAndCasing() {
    $expected = '2,3,NORTH';

    $this->robot->command('PlaCe    2 , 3  ,    nOrTH   ');
    $actual = $this->robot->command('REPORT');

    $this->expectOutputString($expected);
  }

  public function testTurnLeftFromNorth() {
    $expected = '0,0,WEST';

    $this->robot->command('PLACE 0,0,NORTH');
    $this->robot->command('LEFT');
    $this->robot->command('LEFT');
    $this->robot->command('LEFT');
    $this->robot->command('LEFT');
    $this->robot->command('LEFT');
    $this->robot->command('LEFT');
    $this->robot->command('LEFT');
    $this->robot->command('LEFT');
    $this->robot->command('LEFT');
    $this->robot->command('LEFT');
    $this->robot->command('LEFT');
    $this->robot->command('LEFT');
    $this->robot->command('LEFT');
    $actual = $this->robot->command('REPORT');

    $this->expectOutputString($expected);
  }

  public function testTurnRightFromNorth() {
    $expected = '0,0,EAST';

    $this->robot->command('PLACE 0,0,NORTH');
    $this->robot->command('RIGHT');
    $actual = $this->robot->command('REPORT');

    $this->expectOutputString($expected);
  }

  public function testTurnRightMultipleFromNorth() {
    $expected = '0,0,SOUTH';

    $this->robot->command('PLACE 0,0,NORTH');
    $this->robot->command('RIGHT');
    $this->robot->command('RIGHT');
    $this->robot->command('RIGHT');
    $this->robot->command('RIGHT');
    $this->robot->command('RIGHT');
    $this->robot->command('RIGHT');
    $this->robot->command('RIGHT');
    $this->robot->command('RIGHT');
    $this->robot->command('RIGHT');
    $this->robot->command('RIGHT');
    $actual = $this->robot->command('REPORT');

    $this->expectOutputString($expected);
  }

  public function testMovingNorth() {
    $expected = '0,1,NORTH';

    $this->robot->command('PLACE 0,0,NORTH');
    $this->robot->command('MOVE');
    $actual = $this->robot->command('REPORT');

    $this->expectOutputString($expected);
  }

  public function testMovingSouth() {
    $expected = '0,0,SOUTH';

    $this->robot->command('PLACE 0,1,SOUTH');
    $this->robot->command('MOVE');
    $actual = $this->robot->command('REPORT');

    $this->expectOutputString($expected);
  }

  public function testMovingNorthOffTable() {
    $expected = '0,4,NORTH';

    $this->robot->command('PLACE 0,0,NORTH');
    $this->robot->command('MOVE');
    $this->robot->command('MOVE');
    $this->robot->command('MOVE');
    $this->robot->command('MOVE');
    $this->robot->command('MOVE');
    $this->robot->command('MOVE');
    $actual = $this->robot->command('REPORT');

    $this->expectOutputString($expected);
  }

  public function testMovingSouthOffTable() {
    $expected = '0,0,SOUTH';

    $this->robot->command('PLACE 0,4,SOUTH');
    $this->robot->command('MOVE');
    $this->robot->command('MOVE');
    $this->robot->command('MOVE');
    $this->robot->command('MOVE');
    $this->robot->command('MOVE');
    $this->robot->command('MOVE');
    $actual = $this->robot->command('REPORT');

    $this->expectOutputString($expected);
  }

  public function testMovingEastOffTable() {
    $expected = '4,4,EAST';

    $this->robot->command('PLACE 0,4,EAST');
    $this->robot->command('MOVE');
    $this->robot->command('MOVE');
    $this->robot->command('MOVE');
    $this->robot->command('MOVE');
    $this->robot->command('MOVE');
    $this->robot->command('MOVE');
    $actual = $this->robot->command('REPORT');

    $this->expectOutputString($expected);
  }

  public function testMovingWestOffTable() {
    $expected = '0,4,WEST';

    $this->robot->command('PLACE 4,4,WEST');
    $this->robot->command('MOVE');
    $this->robot->command('MOVE');
    $this->robot->command('MOVE');
    $this->robot->command('MOVE');
    $this->robot->command('MOVE');
    $this->robot->command('MOVE');
    $actual = $this->robot->command('REPORT');

    $this->expectOutputString($expected);
  }

  public function testMovingWestOffTableThenMovingSouth() {
    $expected = '0,3,SOUTH';

    $this->robot->command('PLACE 4,4,WEST');
    $this->robot->command('MOVE');
    $this->robot->command('MOVE');
    $this->robot->command('MOVE');
    $this->robot->command('MOVE');
    $this->robot->command('MOVE');
    $this->robot->command('MOVE');
    $this->robot->command('LEFT');
    $this->robot->command('MOVE');
    $actual = $this->robot->command('REPORT');

    $this->expectOutputString($expected);
  }

  public function testExampleA() {
    $expected = '0,1,NORTH';

    $this->robot->command('PLACE 0,0,NORTH');
    $this->robot->command('MOVE');
    $actual = $this->robot->command('REPORT');

    $this->expectOutputString($expected);
  }

  public function testExampleB() {
    $expected = '0,0,WEST';

    $this->robot->command('PLACE 0,0,NORTH');
    $this->robot->command('LEFT');
    $actual = $this->robot->command('REPORT');

    $this->expectOutputString($expected);
  }

  public function testExampleC() {
    $expected = '3,3,NORTH';

    $this->robot->command('PLACE 1,2,EAST');
    $this->robot->command('MOVE');
    $this->robot->command('MOVE');
    $this->robot->command('LEFT');
    $this->robot->command('MOVE');
    $actual = $this->robot->command('REPORT');

    $this->expectOutputString($expected);
  }

  public function testImproperCommandCasingAndFormattingExampleC() {
    $expected = '3,3,NORTH';

    $this->robot->command('PlaCE    1 ,  2   ,  EAsT  ');
    $this->robot->command('MOVe ');
    $this->robot->command(' move');
    $this->robot->command('    LeFt   ');
    $this->robot->command(' movE');

    $actual = $this->robot->command('REpORT');

    $this->expectOutputString($expected);

  }
}
