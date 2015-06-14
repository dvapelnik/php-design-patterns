<?php
namespace Patterns\Creational\AbstractFactory\Maze\MazeFactories\BombedMaze;

use Maze\Map\Door;
use Maze\Map\Room;
use Maze\Map\Wall;
use Patterns\Creational\AbstractFactory\Maze\MazeFactory;

class BombedMazeFactory extends MazeFactory
{
    /**
     * @param $num
     *
     * @return Room
     */
    public function makeRoom($num)
    {
        return new BombedRoom($num);
    }

    /** @return Wall */
    public function makeWall()
    {
        return new BombedWall();
    }

    /**
     * @param $room1
     * @param $room2
     *
     * @return Door
     */
    public function makeDoor($room1, $room2)
    {
        return new BombedDoor($room1, $room2);
    }
}