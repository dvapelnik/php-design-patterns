<?php
namespace Patterns\Creational\AbstractFactory\Maze;

use Maze\Map\SimpleMaze\Door;
use Maze\Map\SimpleMaze\Room;
use Maze\Map\SimpleMaze\Wall;
use Maze\Maze;
use Patterns\Creational\AbstractFactory\Maze\MazeFactoryInterface;
use Patterns\Creational\Singleton\SingletonTrait;

/**
 * Class MazeFactory
 * @package Patterns\Creational\AbstractFactory\Maze
 */
class MazeFactory implements MazeFactoryInterface
{
    use SingletonTrait;

    /** @return Maze */
    final public function makeMaze()
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