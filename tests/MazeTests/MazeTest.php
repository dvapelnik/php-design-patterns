<?php
namespace MazeTests;

use Exception;
use Maze\Map\Room;
use Maze\Maze;
use Maze\MazeGame;
use PHPUnit_Framework_TestCase;

class MazeTest extends PHPUnit_Framework_TestCase
{
    public function wrongRoomProvider()
    {
        return array(
            array(0),
            array(null),
            array('asdas'),
            array(new Exception()),
            array(array()),
            array(
                function () {
                }
            ),
        );
    }

    public function wrongNumberProvider()
    {
        return array(
            array(new Room(0)),
            array(null),
            array('asdas'),
            array(new Exception()),
            array(array()),
            array(
                function () {
                }
            ),
        );
    }

    /**
     * @dataProvider wrongRoomProvider
     * @expectedException \Maze\MazeException
     * @expectedExceptionMessage Room should be instance of \Maze\Map\Room
     */
    public function testAddWrongRoomException($room)
    {
        $maze = new Maze();
        $maze->addRoom(0, $room);
    }

    public function testCountOfRooms()
    {
        $maze = new Maze();

        $countOfRooms = 5;

        for ($i = 0; $i < $countOfRooms; $i++) {
            $maze->addRoom(new Room($i));
        }

        $this->assertEquals($countOfRooms, $maze->getCountOfRooms());
    }

    /**
     * @dataProvider wrongNumberProvider
     * @expectedException \Maze\MazeException
     * @expectedExceptionMessage Room number should be an integer
     */
    public function testGetRoomWithWrongNumber($number)
    {
        $maze = new Maze();
        $maze->getRoom($number);
    }

    /**
     * @expectedException \Maze\RoomNotFoundException
     */
    public function testRoomNotFound()
    {
        $maze = new Maze();
        $maze->addRoom(new Room(0));
        $num = $maze->getRoom(1);
    }

    public function testGetRoomCorrect()
    {
        $num = 0;
        $maze = new Maze();

        $room = new Room($num);
        $maze->addRoom($room);

        $this->assertEquals($room, $maze->getRoom($num));
    }

    public function testCreateMaze()
    {
        $this->assertInstanceOf('\Maze\Maze', MazeGame::CreateMaze());
    }
}