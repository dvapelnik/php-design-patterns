<?php
namespace Maze\Map;

class Door extends MapSite
{
    private $_room1;
    private $_room2;

    private $_isOpen;

    public function __construct(Room $room1, Room $room2)
    {
        if ($room1 === $room2) {
            throw new MapSiteException('room1 and room2 is same object');
        }

        $this->_room1 = $room1;
        $this->_room2 = $room2;
    }
}