<?php
namespace Patterns\Creational\FactoryMethod;

use Maze\Map\MapSite;
use Maze\Map\SimpleMaze\Door;
use Maze\Map\SimpleMaze\Room;
use Maze\Map\SimpleMaze\Wall;
use Maze\Maze;
use Maze\MazeGame as MazeGameOriginal;

abstract class MazeGame extends MazeGameOriginal implements MazeGameFactoryMethodInterface
{
    public function makeMaze()
    {
        return new Maze();
    }

    public function makeWall()
    {
        return new Wall();
    }

    public function makeRoom($num)
    {
        return new Room($num);
    }

    public function makeDoor($room1, $room2)
    {
        return new Door($room1, $room2);
    }

    public function createMaze()
    {
        $maze = $this->makeMaze();
        $room1 = $this->makeRoom(0);
        $room2 = $this->makeRoom(1);
        $door = $this->makeDoor($room1, $room2);

        $room1->setSide(MapSite::DIRECTION_NORTH, $this->makeWall());
        $room1->setSide(MapSite::DIRECTION_EAST, $door);
        $room1->setSide(MapSite::DIRECTION_SOUTH, $this->makeWall());
        $room1->setSide(MapSite::DIRECTION_WEST, $this->makeWall());

        $room2->setSide(MapSite::DIRECTION_NORTH, $this->makeWall());
        $room2->setSide(MapSite::DIRECTION_EAST, $this->makeWall());
        $room2->setSide(MapSite::DIRECTION_SOUTH, $this->makeWall());
        $room2->setSide(MapSite::DIRECTION_WEST, $door);

        $maze->addRoom($room1, array(0, 0));
        $maze->addRoom($room2, array(0, 1));

        return $maze;
    }
}