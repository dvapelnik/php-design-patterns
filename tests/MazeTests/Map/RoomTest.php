<?php
namespace MazeTests\Map;

use Exception;
use Maze\Map\SimpleMaze\Room;
use Maze\Map\SimpleMaze\Wall;
use PHPUnit_Framework_TestCase;

class RoomTest extends PHPUnit_Framework_TestCase
{
    public function randomStringProvider()
    {
        return array(
            array('asdasd'),
            array(0.3),
            array(new Exception()),
            array(array()),
            array(
                function () {
                }
            ),
            array(null),
        );
    }

    public function wrongDirectionProvider()
    {
        return array(
            array(-1),
            array(4),
        );
    }

    public function correctDirectionProvider()
    {
        return array_map(function ($i) {
            return array($i);
        }, range(0, 3));
    }

    public function directionSideProvider()
    {
        return array_map(function ($direction) {
            return array($direction, new Wall());
        }, range(0, 3));
    }

    /**
     * @expectedException Exception
     * @expectedExceptionMessage First argument should be a number
     * @dataProvider randomStringProvider
     */
    public function testConstructorShouldGenerateException($arg)
    {
        $room = new Room($arg);
    }

    public function testConstructor()
    {
        $room = new Room(0);

        $this->assertInstanceOf('Maze\Map\SimpleMaze\Room', $room);
    }

    /**
     * @dataProvider wrongDirectionProvider
     * @expectedException \Maze\Map\MapSiteException
     * @expectedExceptionMessage Direction should be in range: [0, 3]
     */
    public function testGetDirectionShouldGenExcWithWrongDirection($wrongDirection)
    {
        $room = new Room(0);

        $room->getSide($wrongDirection);
    }

    /**
     * @dataProvider randomStringProvider
     * @expectedException \Exception
     * @expectedExceptionMessage Direction should be a number
     */
    public function testGetDirectionShouldGenExcWithStringDirection($stringDirection)
    {
        $room = new Room(0);

        $room->getSide($stringDirection);
    }

    /**
     * @dataProvider correctDirectionProvider
     */
    public function testGetDirectionShouldGenExcWithUnsetDirection($direction)
    {
        $this->setExpectedException(
            '\Maze\Map\MapSiteException',
            "Room have not side on this direction: {$direction}");

        $room = new Room(0);
        $room->getSide($direction);
    }

    /**
     * @dataProvider directionSideProvider
     */
    public function testGetSetSideIsCorrect($direction, Wall $side)
    {
        $room = new Room($direction);
        $room->setSide($direction, $side);

        $this->assertEquals($side, $room->getSide($direction));
    }

    /**
     * @expectedException \Maze\Map\MapSiteException
     * @expectedExceptionMessage Side should be an instance of Wall or Door
     */
    public function testSetSideAsRoom()
    {
        $room = new Room(0);
        $room->setSide(0, new Room(1));
    }

    public function testGetRoomNumber()
    {
        $room = new Room(0);

        $this->assertEquals(0, $room->getRoomNumber());
    }
}