<?php
namespace Patterns\Creational\Prototype\MazeNativeClone\Map;

use Maze\Map\SimpleMaze\Door as DoorOriginal;
use Patterns\Creational\Prototype\InitializeInterface;

abstract class Door extends DoorOriginal implements InitializeInterface
{
    public function initialize($options = array())
    {
        assert(count($options) == 2, '$options array length should have two items');
        assert(isset($options['room1']) && isset($options['room2']),
            '$options array should have a \'room1\' and \'room2\' members');

        $this->_room1 = $options['room1'];
        $this->_room2 = $options['room2'];
    }
}