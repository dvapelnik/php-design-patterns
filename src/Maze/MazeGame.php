<?php
namespace Maze;

use Maze\Map\Door;
use Maze\Map\MapSite;
use Maze\Map\Room;
use Maze\Map\Wall;

class MazeGame
{
    public static function CreateMaze()
    {
        $maze = new Maze();
        $room1 = new Room(1);
        $room2 = new Room(2);
        $door = new Door($room1, $room2);

        $room1->setSide(MapSite::DIRECTION_NORTH, new Wall());
        $room1->setSide(MapSite::DIRECTION_EAST, new Wall());
        $room1->setSide(MapSite::DIRECTION_SOUTH, $door);
        $room1->setSide(MapSite::DIRECTION_WEST, new Wall());

        $room2->setSide(MapSite::DIRECTION_NORTH, $door);
        $room2->setSide(MapSite::DIRECTION_EAST, new Wall());
        $room2->setSide(MapSite::DIRECTION_SOUTH, new Wall());
        $room2->setSide(MapSite::DIRECTION_WEST, new Wall());

        $maze->addRoom($room1);
        $maze->addRoom($room2);

        return $maze;
    }
}