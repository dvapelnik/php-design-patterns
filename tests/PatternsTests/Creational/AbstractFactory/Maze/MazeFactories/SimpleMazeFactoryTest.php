<?php
namespace PatternsTests\Creational\AbstractFactory\Maze\MazeFactories;

use Patterns\Creational\AbstractFactory\Maze\MazeFactories\SimpleMaze\SimpleMazeFactory;
use Patterns\Creational\AbstractFactory\Maze\MazeFactoryInterface;
use PHPUnit_Framework_TestCase;

class SimpleMazeFactoryTest extends PHPUnit_Framework_TestCase
{
    public function simpleFactoryProvider()
    {
        return array(
            array(new SimpleMazeFactory()),
        );
    }

    /**
     * @dataProvider simpleFactoryProvider
     *
     * @param $simpleMazeFactory MazeFactoryInterface
     */
    public function testMakeMaze($simpleMazeFactory)
    {
        $this->assertInstanceOf('\Maze\Maze', $simpleMazeFactory->makeMaze());
    }

    /**
     * @dataProvider simpleFactoryProvider
     *
     * @param $simpleMazeFactory MazeFactoryInterface
     */
    public function testMakeRoom($simpleMazeFactory)
    {
        $this->assertInstanceOf('\Maze\Map\Room', $simpleMazeFactory->makeRoom(0));
    }

    /**
     * @dataProvider simpleFactoryProvider
     *
     * @param $simpleMazeFactory MazeFactoryInterface
     */
    public function testMakeWall($simpleMazeFactory)
    {
        $this->assertInstanceOf('\Maze\Map\Wall', $simpleMazeFactory->makeWall());
    }

    /**
     * @dataProvider simpleFactoryProvider
     *
     * @param $simpleMazeFactory MazeFactoryInterface
     */
    public function testMakeDoor($simpleMazeFactory)
    {
        $this->assertInstanceOf('\Maze\Map\Door',
            $simpleMazeFactory->makeDoor(
                $simpleMazeFactory->makeRoom(0),
                $simpleMazeFactory->makeRoom(1)
            ));
    }
}