<?php
namespace MazeTests;

use Exception;
use Maze\Map\SimpleMaze\Room;
use Maze\Maze;
use Maze\MazeGame;
use PHPUnit_Framework_TestCase;
use ReflectionClass;

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

    public function wrongPlaceArrayByCountProvider()
    {
        return array(
            array(array(0, 1, 2)),
            array(array(0)),
        );
    }

    public function wrongPlaceArrayByTypeProvider()
    {
        return array(
            array(array('a', 0)),
            array(array(0, 'a')),
            array(array(null, 0)),
            array(array(0, null)),
            array(array(0.00, 0)),
            array(array(0, 0.00)),
            array(array(new Exception(), 0)),
            array(array(0, new Exception())),
            array(array(array(), 0)),
            array(array(0, array())),
            array(
                array(
                    function () {
                    },
                    0
                )
            ),
            array(
                array(
                    0,
                    function () {
                    }
                )
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

    /**
     * @dataProvider wrongPlaceArrayByCountProvider
     *
     * @expectedException \Maze\MazeException
     * @expectedExceptionMessage placeArray should have two members
     */
    public function testAddRoomWithWrongPlaceArrayByCount($placeArray)
    {
        $maze = new Maze();

        $maze->addRoom(new Room(0), $placeArray);
    }

    /**
     * @dataProvider wrongPlaceArrayByTypeProvider
     *
     * @expectedException \Maze\MazeException
     * @expectedExceptionMessage placeArray`s members should be an integer
     */
    public function testAddRoomWithWrongPlaceArrayByType($placeArray)
    {
        $maze = new Maze();

        $maze->addRoom(new Room(0), $placeArray);
    }

    public function testGetRoomByPlace()
    {
        $maze = new Maze();

        $room = new Room(0);

        $maze->addRoom($room, array(0, 0));

        $this->assertEquals($room, $maze->getRoomByPlace(array(0, 0)));
    }

    /**
     * @expectedException \Maze\RoomNotFoundException
     */
    public function testGetRoomByPlaceRoomNotFoundException()
    {
        $maze = new Maze();
        $maze->addRoom(new Room(0), array(0, 0));

        $room = $maze->getRoomByPlace(array(1, 1));
    }

    public function testGetPlaceByNum()
    {
        $num = 0;
        $placeArray = array(0, 0);

        $maze = new Maze();
        $maze->addRoom(new Room($num), $placeArray);

        $this->assertEquals($placeArray, $maze->getPlaceByNum($num));
    }

    /**
     * @expectedException \Maze\RoomNotFoundException
     */
    public function testGetPlaceByNumNotFoundException()
    {
        $maze = new Maze();
        $maze->addRoom(new Room(0), array(0, 0));

        $placeArray = $maze->getPlaceByNum(1);
    }

    public function testMakeIndex()
    {
        $maze = new Maze();

        $reflectedObject = new ReflectionClass($maze);
        $reflectedMethod = $reflectedObject->getMethod('makeIndex');
        $reflectedMethod->setAccessible(true);

        $this->assertEquals('0|0', $reflectedMethod->invoke($maze, array(0, 0)));
    }

    public function testParseIndex()
    {
        $maze = new Maze();

        $reflectedObject = new ReflectionClass($maze);
        $reflectedMethod = $reflectedObject->getMethod('parseIndex');
        $reflectedMethod->setAccessible(true);

        $this->assertEquals(array(0, 0), $reflectedMethod->invoke($maze, '0|0'));
    }
}