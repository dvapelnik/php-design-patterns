<?php
namespace Maze\Map\SimpleMaze;

use Maze\Map\MapSite;
use Maze\Map\MapSiteException;

class Door extends MapSite
{
    protected $_room1;
    protected $_room2;

    protected $_isOpen;

    public function __construct(Room $room1, Room $room2)
    {
        if ($room1 === $room2) {
            throw new MapSiteException('room1 and room2 is same object');
        }

        $this->_room1 = $room1;
        $this->_room2 = $room2;
    }
}