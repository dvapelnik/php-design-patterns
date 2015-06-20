<?php
namespace Patterns\Creational\Prototype\MazeNativeClone;

use Patterns\Creational\AbstractFactory\Maze\MazeFactoryInterface;
use Patterns\Creational\Prototype\MazeNativeClone\Map\Door;
use Patterns\Creational\Prototype\MazeNativeClone\Map\Room;
use Patterns\Creational\Prototype\MazeNativeClone\Map\Wall;

class MazePrototypeFactoryWithNativeClone implements MazeFactoryInterface
{
    private $_prototypeMaze;
    private $_prototypeWall;
    private $_prototypeRoom;
    private $_prototypeDoor;

    public function __construct(Maze $maze, Wall $wall, Room $room, Door $door)
    {
        $this->_prototypeMaze = $maze;
        $this->_prototypeWall = $wall;
        $this->_prototypeRoom = $room;
        $this->_prototypeDoor = $door;
    }

    /**
     * @return Maze
     */
    public function makeMaze()
    {
        $maze = clone $this->_prototypeMaze;
        $maze->initialize();

        return $maze;
    }

    /**
     * @return Wall
     */
    public function makeWall()
    {
        $wall = clone $this->_prototypeWall;
        $wall->initialize();

        return $wall;
    }

    /**
     * @param $num
     *
     * @return Room
     */
    public function makeRoom($num)
    {
        $room = clone $this->_prototypeRoom;
        $room->initialize(array('num' => $num));

        return $room;
    }

    /**
     * @param $room1
     * @param $room2
     *
     * @return Door
     */
    public function makeDoor($room1, $room2)
    {
        $door = clone $this->_prototypeDoor;
        $door->initialize(array(
            'room1' => $room1,
            'room2' => $room2,
        ));

        return $door;
    }
}