<?php
namespace Patterns\Creational\Prototype\Maze;

use Patterns\Creational\AbstractFactory\Maze\MazeFactory;
use Patterns\Creational\AbstractFactory\Maze\MazeFactoryInterface;
use Patterns\Creational\Prototype\Maze\Map\SimpleMaze\Door;
use Patterns\Creational\Prototype\Maze\Map\SimpleMaze\Room;
use Patterns\Creational\Prototype\Maze\Map\SimpleMaze\Wall;

class MazePrototypeFactory implements MazeFactoryInterface
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
        $maze = $this->_prototypeMaze->makeClone();
        $maze->initialize();

        return $maze;
    }

    /**
     * @return Wall
     */
    public function makeWall()
    {
        $wall = $this->_prototypeWall->makeClone();
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
        $room = $this->_prototypeRoom->makeClone();
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
        $door = $this->_prototypeDoor->makeClone();
        $door->initialize(array(
            'room1' => $room1,
            'room2' => $room2,
        ));

        return $door;
    }
}