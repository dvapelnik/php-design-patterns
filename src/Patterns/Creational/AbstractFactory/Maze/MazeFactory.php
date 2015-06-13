<?php
namespace Patterns\Creational\AbstractFactory\Maze;

use Maze\Map\Door;
use Maze\Map\Room;
use Maze\Map\Wall;
use Maze\Maze;
use Patterns\Creational\AbstractFactory\Maze\MazeFactoryInterface;

class MazeFactory implements MazeFactoryInterface
{
    /** @return Maze */
    public function makeMaze()
    {
        return new Maze();
    }

    /**
     * @param $num
     *
     * @return Room
     */
    public function makeRoom($num)
    {
        return new Room($num);
    }

    /** @return Wall */
    public function makeWall()
    {
        return new Wall();
    }

    /**
     * @param $room1
     * @param $room2
     *
     * @return Door
     */
    public function makeDoor($room1, $room2)
    {
        return new Door($room1, $room2);
    }
}