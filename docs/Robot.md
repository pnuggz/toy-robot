# /Robot

Robot is a class that represents the toy robot that is
to receive commands, and action them  


## Constants

| Name | Description |
|------|-------------|
|[TABLE_WIDTH](#robottablewidth)|The width of the table top|
|[TABLE_HEIGHT](#robottableheight)|The height of the table top|
|[DIRECTION_DICT](#robotdirection_dict)|A dictionary of the valid direction inputs, and its corresponding degrees|



### TABLE_WIDTH  

**Description**

```php
TABLE_WIDTH = 5
```

The width of the table top

<hr />


### TABLE_HEIGHT  

**Description**

```php
TABLE_HEIGHT = 5
```

The height of the table top

<hr />


### DIRECTION_DICT 

**Description**

```php
DIRECTION_DICT = [
  'north' => 0,
  'east' => 90,
  'south' => 180,
  'west' => 270
]
```

A dictionary of the valid direction inputs, and its corresponding degrees

<hr />



## Properties

| Name | Description |
|------|-------------|
|[x_max](#robotx_max)|The maximum x position|
|[y_max](#roboty_max)|The maximum y position|
|[x](#robotx)|The curent x position|
|[y](#roboty)|The curent y position|
|[direction](#robotdirection)|The curent direction|
|[is_placed](#robotis_placed)|whether the robot has been placed on the table|
|[is_on](#robotis_on)|whether the robot is ready to take commands|


### $x_max  

**Description**

```php
$x_max :integer
```

The maximum x position based on the tabletop width

<hr />


### $y_max  

**Description**

```php
$y_max :integer
```

The maximum y position based on the tabletop height

<hr />


### $x  

**Description**

```php
$x :integer
```

The curent x position of the robot

<hr />


### $y  

**Description**

```php
$y :integer
```

The curent y position of the robot

<hr />


### $direction  

**Description**

```php
$direction :integer
```

The the curent direction of the robot in degrees (between 0 - 360)

<hr />


### $is_placed  

**Description**

```php
$is_placed :bool
```

Indicates whether the robot has been placed on the table or not

<hr />


### $is_on  

**Description**

```php
$is_on :bool
```

Indicates whether the robot is on and ready to take commands or not

<hr />



## Methods

| Name | Description |
|------|-------------|
|[__construct](#robot__construct)|Initialises the robot|
|[isOn](#robotison)|Whether the robot is ready|
|[command](#robotcommand)|Parses the command input, and issues action|
|[placeRobot](#robotplacerobot)|Place the robot on the tabletop|
|[checkPositionX](#robotcheckpositionx)|Validates the x coordinate input|
|[checkPositionY](#robotcheckpositiony)|Validates the y coordinate input|
|[checkDirection](#robotcheckdirection)|Validates the input direction|
|[resetPlacement](#robotresetplacement)|Resets the robot|
|[turnLeft](#robotturnleft)|Turn -90 degrees in direction|
|[turnRight](#robotturnright)|Turn 90 degrees in direction|
|[move](#robotmove)|Moves the robot 1 full unit if possible|
|[report](#robotreport)|Provides a final out of its position and direction|
|[isOnTable](#robotisontable)|Checks if the robot is on the table|
|[turnOff](#robotturn off)|Turns the robot off|



### Robot::__construct  

**Description**

```php
public __construct()
```

Initialises the robot

 

**Parameters**

* `This function has no parameters.`

**Return Values**

`void`




<hr />




### Robot::isOn  

**Description**

```php
public isOn()
```

Returns a boolean whether the robot is ready to receive commands

 

**Parameters**

* `This function has no parameters.`

**Return Values**

`bool`




<hr />



### Robot::command  

**Description**

```php
public command(string $instruction = null)
```

Parses the command input, and issues an action if it matches on of the pre-defined instructions

 

**Parameters**

* `(string) $instruction`
: The input command issued to the robot. Defaults to null

**Return Values**

`void`




<hr />



### Robot::placeRobot  

**Description**

```php
private placeRobot(string $instruction)
```

Place the robot on the tabletop if the values are validated

 

**Parameters**

* `(string) $instruction`
: The proposed X,Y coordinate and direction the robot is facing

**Return Values**

`void`




<hr />



### Robot::checkPositionX  

**Description**

```php
private checkPositionX(int $x)
```

Validates the x coordinate input for the robot starting position is valid

 

**Parameters**

* `(integer) $x`
: The proposed X coordinate of the robot to be set

**Return Values**

`bool`




<hr />



### Robot::checkPositionY  

**Description**

```php
private checkPositionY(int $y)
```

Validates the y coordinate input for the robot starting position is valid

 

**Parameters**

* `(integer) $y`
: The proposed Y coordinate of the robot to be set

**Return Values**

`bool`




<hr />



### Robot::checkDirection  

**Description**

```php
private checkDirection(string $direction)
```

Validates the input direction where the robot is facing as a starting position is valid

 

**Parameters**

* `(string) $direction`
: A string representing the direction the robot is facing

**Return Values**

`bool`




<hr />



### Robot::resetPlacement  

**Description**

```php
private resetPlacement()
```

Take the robot off the table, and reset all values

 

**Parameters**

* `This function has no parameters.`

**Return Values**

`void`




<hr />



### Robot::turnLeft  

**Description**

```php
private turnLeft()
```

Turn -90 degrees in direction if the robot is on the table

 

**Parameters**

* `This function has no parameters.`

**Return Values**

`void`




<hr />



### Robot::turnRight  

**Description**

```php
private turnRight()
```

Turn 90 degrees in direction if the robot is on the table

 

**Parameters**

* `This function has no parameters.`

**Return Values**

`void`




<hr />



### Robot::move  

**Description**

```php
private move()
```

Moves the robot 1 full unit if the robot is on the table, and it will not result in the robot falling off the table

 

**Parameters**

* `This function has no parameters.`

**Return Values**

`void`




<hr />



### Robot::report  

**Description**

```php
private report()
```

Turns the robot off, and provides a final out of its position and direction

 

**Parameters**

* `This function has no parameters.`

**Return Values**

`void`




<hr />



### Robot::isOnTable  

**Description**

```php
private isOnTable()
```

Checks whether the robot has been placed on the table or not

 

**Parameters**

* `This function has no parameters.`

**Return Values**

`bool`




<hr />



### Robot::turnOff  

**Description**

```php
private turnOff()
```

Turns the robot off so that it no longer accepts/waits for a command

 

**Parameters**

* `This function has no parameters.`

**Return Values**

`void`




<hr />

