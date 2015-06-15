<?php
namespace Patterns\Creational\AbstractFactory\Maze\MazeFactories;

use Maze\Map\BombedMaze\BombedDoor;
use Maze\Map\BombedMaze\BombedRoom;
use Maze\Map\BombedMaze\BombedWall;
use Maze\Map\SimpleMaze\Door;
use Maze\Map\SimpleMaze\Room;
use Maze\Map\SimpleMaze\Wall;
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