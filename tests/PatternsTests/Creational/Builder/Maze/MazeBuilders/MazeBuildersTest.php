<?php
namespace PatternsTests\Creational\Builder\Maze\MazeBuilders;

use Patterns\Creational\AbstractFactory\Maze\MazeFactories\BombedMazeFactory;
use Patterns\Creational\Builder\Maze\MazeBuilder;
use Patterns\Creational\Builder\Maze\MazeBuilders\BombedMazeBuilder;
use Patterns\Creational\Builder\Maze\MazeBuilders\MagicMazeBuilder;
use Patterns\Creational\Builder\Maze\MazeBuilders\SimpleMazeBuilder;
use ReflectionClass;

class MazeBuildersTest extends \PHPUnit_Framework_TestCase
{
    public function roomsAndCommonDirectionProvider()
    {
        $builders = array(
            new SimpleMazeBuilder(),
            new BombedMazeBuilder(),
            new MagicMazeBuilder(),
        );
        $args = array(
            array(array(0, 0), array(0, 1), 1, 3),
            array(array(0, 1), array(0, 0), 3, 1),
            array(array(0, -1), array(0, 0), 1, 3),
            array(array(0, 0), array(1, 0), 2, 0),
            array(array(1, 0), array(0, 0), 0, 2),
            array(array(0, 0), array(2, 2), false, false),
        );

        $data = array();

        foreach ($builders as $builder) {
            foreach ($args as $arg) {
                $data[] = array_merge(array($builder), $arg);
            }
        }

        return $data;
    }

    /**
     * @dataProvider roomsAndCommonDirectionProvider
     *
     * @param $mazeBuilder MazeBuilder
     * @param $room1PlaceArray
     * @param $room2PlaceArray
     * @param $room1ToRoom2Dir
     * @param $room2ToRoom1Dir
     */
    public function testCommonDirection(
        $mazeBuilder,
        $room1PlaceArray,
        $room2PlaceArray,
        $room1ToRoom2Dir,
        $room2ToRoom1Dir
    ) {
        $room1Num = 1;
        $room2Num = 2;

//        $mazeBuilder = new SimpleMazeBuilder();
        $mazeBuilder->buildMaze();

        $mazeBuilder->buildMaze();
        $mazeBuilder->buildRoom($room1Num, $room1PlaceArray);
        $mazeBuilder->buildRoom($room2Num, $room2PlaceArray);

        $reflection = new ReflectionClass($mazeBuilder);
        $method = $reflection->getMethod('directionToCommonWall');
        $method->setAccessible(true);

        $this->assertEquals($room1ToRoom2Dir, $method->invokeArgs($mazeBuilder, array(
            $mazeBuilder->getMaze()->getRoomByNum($room1Num),
            $mazeBuilder->getMaze()->getRoomByNum($room2Num),
        )));

        $this->assertEquals($room2ToRoom1Dir, $method->invokeArgs($mazeBuilder, array(
            $mazeBuilder->getMaze()->getRoomByNum($room2Num),
            $mazeBuilder->getMaze()->getRoomByNum($room1Num),
        )));
    }

    public function mazeBuildersProvider()
    {
        return array(
            array(new SimpleMazeBuilder()),
            array(new BombedMazeBuilder()),
            array(new MagicMazeBuilder()),
        );
    }

    /**
     * @dataProvider mazeBuildersProvider
     *
     * @param $mazeBuilder MazeBuilder
     */
    public function testAddRoom($mazeBuilder)
    {
        $mazeBuilder->buildMaze();

        $mazeBuilder->buildRoom(0, array(0, 0));

        $this->assertEquals(1, $mazeBuilder->getMaze()->getCountOfRooms());

        $mazeBuilder->buildRoom(1, array(0, 1));

        $this->assertEquals(2, $mazeBuilder->getMaze()->getCountOfRooms());
    }

    /**
     * @dataProvider mazeBuildersProvider
     *
     * @param $mazeBuilder MazeBuilder
     */
    public function testBuildDoor($mazeBuilder)
    {
        $mazeBuilder->buildMaze();

        $room1Num = 0;
        $room1PlaceArray = array(0, 0);

        $room2Num = 1;
        $room2PlaceArray = array(0, 1);

        $mazeBuilder->buildRoom($room1Num, $room1PlaceArray);
        $mazeBuilder->buildRoom($room2Num, $room2PlaceArray);

        $reflectedSimpleMazeBuilder = new ReflectionClass(
            'Patterns\Creational\Builder\Maze\MazeBuilders\SimpleMazeBuilder');
        $reflectedDirectionToCommonWallMethod = $reflectedSimpleMazeBuilder->getMethod('directionToCommonWall');
        $reflectedDirectionToCommonWallMethod->setAccessible(true);

        $room1 = $mazeBuilder->getMaze()->getRoomByPlace($room1PlaceArray);
        $room2 = $mazeBuilder->getMaze()->getRoomByPlace($room2PlaceArray);

        $room1DoorDirection = $reflectedDirectionToCommonWallMethod->invokeArgs(
            $mazeBuilder, array($room1, $room2));
        $room2DoorDirection = $reflectedDirectionToCommonWallMethod->invokeArgs(
            $mazeBuilder, array($room2, $room1));

        $mazeBuilder->buildDoor($room1Num, $room2Num);

        $this->assertInstanceOf('Maze\Map\SimpleMaze\Door', $doorFromRoom1 = $room1->getSide($room1DoorDirection));
        $this->assertInstanceOf('Maze\Map\SimpleMaze\Door', $doorFromRoom2 = $room2->getSide($room2DoorDirection));

        $this->assertEquals($doorFromRoom1, $doorFromRoom2);
    }
}