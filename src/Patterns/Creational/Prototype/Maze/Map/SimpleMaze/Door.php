<?php
namespace Patterns\Creational\Prototype\Maze\Map\SimpleMaze;

use Maze\Map\SimpleMaze\Door as DoorOriginal;
use Patterns\Creational\Prototype\CloneInterface;

class Door extends DoorOriginal implements CloneInterface
{

    public function makeClone()
    {
        return new static($this->_room1, $this->_room2);
    }

    public function initialize($options = array())
    {
        assert(count($options) == 2, '$options array length should have two items');
        assert(isset($options['room1']) && isset($options['room2']),
            '$options array should have a \'room1\' and \'room2\' members');

        $this->_room1 = $options['room1'];
        $this->_room2 = $options['room2'];
    }
}