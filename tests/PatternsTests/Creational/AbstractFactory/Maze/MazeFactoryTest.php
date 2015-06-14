<?php
namespace PatternsTests\Creational\AbstractFactory\Maze;

use Patterns\Creational\AbstractFactory\Maze\MazeFactories\BombedMaze\BombedMazeFactory;
use Patterns\Creational\AbstractFactory\Maze\MazeFactories\SimpleMaze\SimpleMazeFactory;
use Patterns\Creational\AbstractFactory\Maze\MazeFactories\MagicMaze\MagicMazeFactory;
use PHPUnit_Framework_TestCase;

class MazeFactoryTest extends PHPUnit_Framework_TestCase
{
    public function factoryProvider()
    {
        return array(
            array(
                SimpleMazeFactory::getInstance(),
                array(
                    array(
                        'method'        => 'makeMaze',
                        'arguments'     => array(),
                        'expectedClass' => '\Maze\Maze',
                    ),
                    array(
                        'method'        => 'makeWall',
                        'arguments'     => array(),
                        'expectedClass' => '\Maze\Map\Wall',
                    ),
                    array(
                        'method'        => 'makeRoom',
                        'arguments'     => array(0),
                        'expectedClass' => '\Maze\Map\Room',
                    ),
                    array(
                        'method'        => 'makeDoor',
                        'arguments'     => array(
                            SimpleMazeFactory::getInstance()->makeRoom(0),
                            SimpleMazeFactory::getInstance()->makeRoom(1)
                        ),
                        'expectedClass' => '\Maze\Map\Door',
                    ),
                )
            ),
            array(
                BombedMazeFactory::getInstance(),
                array(
                    array(
                        'method'        => 'makeMaze',
                        'arguments'     => array(),
                        'expectedClass' => '\Maze\Maze',
                    ),
                    array(
                        'method'        => 'makeWall',
                        'arguments'     => array(),
                        'expectedClass' => 'Patterns\Creational\AbstractFactory\Maze\MazeFactories\BombedMaze\BombedWall',
                    ),
                    array(
                        'method'        => 'makeRoom',
                        'arguments'     => array(0),
                        'expectedClass' => 'Patterns\Creational\AbstractFactory\Maze\MazeFactories\BombedMaze\BombedRoom',
                    ),
                    array(
                        'method'        => 'makeDoor',
                        'arguments'     => array(
                            BombedMazeFactory::getInstance()->makeRoom(0),
                            BombedMazeFactory::getInstance()->makeRoom(1)
                        ),
                        'expectedClass' => 'Patterns\Creational\AbstractFactory\Maze\MazeFactories\BombedMaze\BombedDoor',
                    ),
                )
            ),
            array(
                MagicMazeFactory::getInstance(),
                array(
                    array(
                        'method'        => 'makeMaze',
                        'arguments'     => array(),
                        'expectedClass' => '\Maze\Maze',
                    ),
                    array(
                        'method'        => 'makeWall',
                        'arguments'     => array(),
                        'expectedClass' => 'Patterns\Creational\AbstractFactory\Maze\MazeFactories\MagicMaze\MagicWall',
                    ),
                    array(
                        'method'        => 'makeRoom',
                        'arguments'     => array(0),
                        'expectedClass' => 'Patterns\Creational\AbstractFactory\Maze\MazeFactories\MagicMaze\MagicRoom',
                    ),
                    array(
                        'method'        => 'makeDoor',
                        'arguments'     => array(
                            BombedMazeFactory::getInstance()->makeRoom(0),
                            BombedMazeFactory::getInstance()->makeRoom(1)
                        ),
                        'expectedClass' => 'Patterns\Creational\AbstractFactory\Maze\MazeFactories\MagicMaze\MagicDoor',
                    ),
                )
            ),
        );
    }

    /**
     * @dataProvider factoryProvider
     */
    public function testFactories($factory, $classes)
    {
        foreach ($classes as $class) {
            $this->assertInstanceOf(
                $class['expectedClass'],
                call_user_func_array(array($factory, $class['method']), $class['arguments']));
        }
    }
}