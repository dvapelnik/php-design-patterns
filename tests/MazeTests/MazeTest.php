<?php
namespace MazeTests;

use Exception;
use Maze\Map\SimpleMaze\Room;
use Maze\Maze;
use Maze\MazeGame;
use PHPUnit_Framework_TestCase;

class MazeTest extends PHPUnit_Framework_TestCase
{
    /** @var  MazeGame */
    private $_mazeGame;

    public function setUp()
    {
        $this->_mazeGame = new MazeGame();
    }

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
        $maze->addRoom($room, array(0, 0));
    }

    public function testCountOfRooms()
    {
        $maze = new Maze();

        $countOfRooms = 5;

        for ($i = 0; $i < $countOfRooms; $i++) {
            $maze->addRoom(new Room($i), array(0, $i));
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
        $maze->getRoomByNum($number);
    }

    /**
     * @expectedException \Maze\RoomNotFoundException
     */
    public function testRoomNotFound()
    {
        $maze = new Maze();
        $maze->addRoom(new Room(0), array(0, 0));
        $num = $maze->getRoomByNum(1);
    }

    public function testGetRoomCorrect()
    {
        $num = 0;
        $maze = new Maze();

        $room = new Room($num);
        $maze->addRoom($room, array(0, 0));

        $this->assertEquals($room, $maze->getRoomByNum($num));
    }

    public function testCreateMaze()
    {
        $this->assertInstanceOf('\Maze\Maze', $this->_mazeGame->createMaze());
    }
}