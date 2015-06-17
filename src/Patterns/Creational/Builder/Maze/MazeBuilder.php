<?php
namespace Patterns\Creational\Builder\Maze;

use Maze\Map\MapSite;
use Maze\Map\SimpleMaze\Door;
use Maze\Map\SimpleMaze\Room;
use Maze\Maze;

abstract class MazeBuilder implements MazeBuilderInterface
{
    /** @var  Maze */
    protected $_maze;

    protected static $_classMap = array();

    public function buildMaze()
    {
        $this->_maze = new Maze();
    }

    public function buildRoom($num, $placeArray)
    {
        $this->_buildRoom(static::$_classMap['room'], $num, $placeArray);
    }

    public function buildDoor($room1Num, $room2Num)
    {
        $this->_buildDoor(static::$_classMap['door'], $room1Num, $room2Num);
    }

    public function getMaze()
    {
        return $this->_maze;
    }

    /**
     * @param $room1 Room
     * @param $room2 Room
     */
    protected function directionToCommonWall($room1, $room2)
    {
        $room1PlaceArray = $this->_maze->getPlaceByNum($room1->getRoomNumber());
        $room2PlaceArray = $this->_maze->getPlaceByNum($room2->getRoomNumber());

        if ($room1PlaceArray[0] - $room2PlaceArray[0] == -1) {
            return MapSite::DIRECTION_SOUTH;
        } elseif ($room1PlaceArray[0] - $room2PlaceArray[0] == 1) {
            return MapSite::DIRECTION_NORTH;
        } elseif ($room1PlaceArray[1] - $room2PlaceArray[1] == -1) {
            return MapSite::DIRECTION_EAST;
        } elseif ($room1PlaceArray[1] - $room2PlaceArray[1] == 1) {
            return MapSite::DIRECTION_WEST;
        } else {
            return false;
        }
    }

    protected function _buildRoom($roomClass, $num, $placeArray)
    {
        $this->_maze->addRoom(new $roomClass($num), $placeArray);
    }

    /**
     * @param $door Door
     * @param $room1 Room
     * @param $room2 Room
     */
    protected function _buildDoor($doorClass, $room1Num, $room2Num)
    {
        $room1 = $this->_maze->getRoomByNum($room1Num);
        $room2 = $this->_maze->getRoomByNum($room2Num);

        /** @var Door $door */
        $door = new $doorClass($room1, $room2);

        $room1Direction = $this->directionToCommonWall($room1, $room2);
        $room1->setSide($room1Direction, $door);

        $room2Direction = $this->directionToCommonWall($room2, $room1);
        $room2->setSide($room2Direction, $door);
    }
}