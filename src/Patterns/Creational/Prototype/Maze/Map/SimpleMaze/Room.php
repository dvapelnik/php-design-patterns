<?php
namespace Patterns\Creational\Prototype\Maze\Map\SimpleMaze;

use Maze\Map\SimpleMaze\Room as RoomOriginal;
use Patterns\Creational\Prototype\CloneInterface;

class Room extends RoomOriginal implements CloneInterface
{

    public function makeClone()
    {
        return new static($this->getRoomNumber());
    }

    public function initialize($options = array())
    {
        assert(count($options) == 1, '$options array length should one item');
        assert(isset($options['num']), '$options array should have a \'num\' member');

        $this->_roomNumber = $options['num'];
    }
}