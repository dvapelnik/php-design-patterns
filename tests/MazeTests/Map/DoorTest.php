<?php
namespace MazeTests\Map;

use Maze\Map\Door;
use Maze\Map\Room;
use PHPUnit_Framework_TestCase;

class DoorTest extends PHPUnit_Framework_TestCase
{
    public function testConstructorIsCorrect()
    {
        $door = new Door(new Room(1), new Room(2));

        $this->assertInstanceOf('\Maze\Map\Door', $door);
    }

    /**
     * @expectedException \Maze\Map\MapSiteException
     * @expectedExceptionMessage room1 and room2 is same object
     */
    public function testDoorWithSameRooms()
    {
        $room = new Room(0);

        $door = new Door($room, $room);
    }
}