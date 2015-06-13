<?php
namespace Maze;

use Maze\Map\Room;

class Maze
{
    private $_rooms = array();

    public function addRoom($room)
    {
        if (!$room instanceof Room) {
            throw new MazeException('Room should be instance of \Maze\Map\Room');
        }

        $this->_rooms[] = $room;
    }

    public function getCountOfRooms()
    {
        return count($this->_rooms);
    }

    public function getRoom($num)
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
}