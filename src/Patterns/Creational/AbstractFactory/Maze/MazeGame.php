<?php
namespace Patterns\Creational\AbstractFactory\Maze;

use Maze\Map\MapSite;
use \Maze\MazeGame as MazeGameOriginal;

class MazeGame extends MazeGameOriginal
{
    public static function CreateMaze(MazeFactoryInterface $mazeFactory)
    {
        $maze = $mazeFactory->makeMaze();
        $room1 = $mazeFactory->makeRoom(0);
        $room2 = $mazeFactory->makeRoom(2);
        $door = $mazeFactory->makeDoor($room1, $room2);

        $room1->setSide(MapSite::DIRECTION_NORTH, $mazeFactory->makeWall());
        $room1->setSide(MapSite::DIRECTION_EAST, $mazeFactory->makeWall());
        $room1->setSide(MapSite::DIRECTION_SOUTH, $door);
        $room1->setSide(MapSite::DIRECTION_WEST, $mazeFactory->makeWall());

        $room2->setSide(MapSite::DIRECTION_SOUTH, $door);
        $room2->setSide(MapSite::DIRECTION_NORTH, $mazeFactory->makeWall());
        $room2->setSide(MapSite::DIRECTION_EAST, $mazeFactory->makeWall());
        $room2->setSide(MapSite::DIRECTION_WEST, $mazeFactory->makeWall());

        $maze->addRoom($room1);
        $maze->addRoom($room2);

        return $maze;
    }
}