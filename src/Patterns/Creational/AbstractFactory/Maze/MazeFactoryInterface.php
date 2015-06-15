<?php
namespace Patterns\Creational\AbstractFactory\Maze;

use Maze\Map\SimpleMaze\Door;
use Maze\Map\SimpleMaze\Room;
use Maze\Map\SimpleMaze\Wall;
use Maze\Maze;

interface MazeFactoryInterface
{
    /** @return Maze */
    public function makeMaze();

    /**
     * @param $num
     *
     * @return Room
     */
    public function makeRoom($num);

    /** @return Wall */
    public function makeWall();

    /**
     * @param $room1
     * @param $room2
     *
     * @return Door
     */
    public function makeDoor($room1, $room2);
}