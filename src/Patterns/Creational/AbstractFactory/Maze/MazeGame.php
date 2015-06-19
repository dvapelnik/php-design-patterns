<?php
namespace Patterns\Creational\AbstractFactory\Maze;

use Maze\Map\MapSite;
use \Maze\MazeGame as MazeGameOriginal;

class MazeGame extends MazeGameOriginal
{
    public function createMaze(MazeFactoryInterface $mazeFactory)
    {
        $maze = $mazeFactory->makeMaze();
        $room1 = $mazeFactory->makeRoom(0);
        $room2 = $mazeFactory->makeRoom(1);
        $door = $mazeFactory->makeDoor($room1, $room2);

        $room1->setSide(MapSite::DIRECTION_NORTH, $mazeFactory->makeWall());
        $room1->setSide(MapSite::DIRECTION_EAST, $door);
        $room1->setSide(MapSite::DIRECTION_SOUTH, $mazeFactory->makeWall());
        $room1->setSide(MapSite::DIRECTION_WEST, $mazeFactory->makeWall());

        $room2->setSide(MapSite::DIRECTION_SOUTH, $mazeFactory->makeWall());
        $room2->setSide(MapSite::DIRECTION_NORTH, $mazeFactory->makeWall());
        $room2->setSide(MapSite::DIRECTION_EAST, $mazeFactory->makeWall());
        $room2->setSide(MapSite::DIRECTION_WEST, $door);

        $maze->addRoom($room1, array(0, 0));
        $maze->addRoom($room2, array(0, 1));

        return $maze;
    }
}