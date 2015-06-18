<?php
namespace Maze;

use Maze\Map\SimpleMaze\Room;

class Maze
{
    private $_rooms = array();

    public function addRoom($room, $placeArray)
    {
        if (!$room instanceof Room) {
            throw new MazeException('Room should be instance of \Maze\Map\Room');
        }

        if (count($placeArray) !== 2) {
            throw new MazeException('placeArray should have two members');
        }

        if (!is_int($placeArray[0]) || !is_int($placeArray[1])) {
            throw new MazeException('placeArray`s members should be an integer');
        }

        $this->_rooms[$this->makeIndex($placeArray)] = $room;
    }

    public function getCountOfRooms()
    {
        return count($this->_rooms);
    }

    /**
     * @param $num
     *
     * @return Room|mixed
     * @throws MazeException
     * @throws RoomNotFoundException
     */
    public function getRoomByNum($num)
    {
        if (!is_int($num)) {
            throw new MazeException('Room number should be an integer');
        }

        $roomsFiltered = array_filter($this->_rooms, function (Room $room) use ($num) {
            return $room->getRoomNumber() == $num;
        });

        if (count($roomsFiltered)) {
            return current($roomsFiltered);
        } else {
            throw new RoomNotFoundException();
        }
    }

    /**
     * @param $placeArray
     *
     * @return Room|mixed
     * @throws RoomNotFoundException
     */
    public function getRoomByPlace($placeArray)
    {
        if (isset($this->_rooms[$this->makeIndex($placeArray)])) {
            return $this->_rooms[$this->makeIndex($placeArray)];
        } else {
            throw new RoomNotFoundException();
        }
    }

    public function getPlaceByNum($num)
    {
        try {
            $room = $this->getRoomByNum($num);

            return $this->parseIndex(array_search($room, $this->_rooms));
        } catch(RoomNotFoundException $roomNotFoundExpt) {
            throw $roomNotFoundExpt;
        }
    }

    protected function makeIndex($placeArray)
    {
        return implode('|', $placeArray);
    }

    protected function parseIndex($index)
    {
        return explode('|', $index);
    }
}