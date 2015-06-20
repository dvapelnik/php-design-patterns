<?php
namespace Patterns\Creational\Prototype\MazeNativeClone\Map;

use Maze\Map\SimpleMaze\Room as RoomOriginal;
use Patterns\Creational\Prototype\InitializeInterface;

abstract class Room extends RoomOriginal implements InitializeInterface
{
    public function initialize($options = array())
    {
        assert(count($options) == 1, '$options array length should one item');
        assert(isset($options['num']), '$options array should have a \'num\' member');

        $this->_roomNumber = $options['num'];
    }
}