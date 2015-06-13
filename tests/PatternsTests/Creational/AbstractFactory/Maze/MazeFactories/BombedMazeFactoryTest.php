<?php
namespace Patterns\Creational\AbstractFactory\Maze\MazeFactories;

use Patterns\Creational\AbstractFactory\Maze\MazeFactories\BombedMaze\BombedMazeFactory;
use Patterns\Creational\AbstractFactory\Maze\MazeFactoryInterface;

class BombedMazeFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function bombedFactoryProvider()
    {
        return array(
            array(new BombedMazeFactory()),
        );
    }

    /**
     * @dataProvider bombedFactoryProvider
     *
     * @param $bombedFactory MazeFactoryInterface
     */
    public function testMakeMaze($bombedFactory)
    {
        $this->assertInstanceOf('\Maze\Maze', $bombedFactory->makeMaze());
    }

    /**
     * @dataProvider bombedFactoryProvider
     *
     * @param $bombedFactory MazeFactoryInterface
     */
    public function testMakeRoom($bombedFactory)
    {
        $this->assertInstanceOf(
            'Patterns\Creational\AbstractFactory\Maze\MazeFactories\BombedMaze\BombedRoom',
            $bombedFactory->makeRoom(0));
    }

    /**
     * @dataProvider bombedFactoryProvider
     *
     * @param $bombedFactory MazeFactoryInterface
     */
    public function testMakeWall($bombedFactory)
    {
        $this->assertInstanceOf(
            'Patterns\Creational\AbstractFactory\Maze\MazeFactories\BombedMaze\BombedWall',
            $bombedFactory->makeWall());
    }

    /**
     * @dataProvider bombedFactoryProvider
     *
     * @param $bombedFactory MazeFactoryInterface
     */
    public function testMakeDoor($bombedFactory)
    {
        $this->assertInstanceOf(
            'Patterns\Creational\AbstractFactory\Maze\MazeFactories\BombedMaze\BombedDoor',
            $bombedFactory->makeDoor(
                $bombedFactory->makeRoom(0),
                $bombedFactory->makeRoom(1)
            ));
    }
}