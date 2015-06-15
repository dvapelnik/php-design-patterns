<?php
namespace PatternsTests\Creational\AbstractFactory\Maze;

use Patterns\Creational\AbstractFactory\Maze\MazeFactories\BombedMazeFactory;
use Patterns\Creational\AbstractFactory\Maze\MazeFactories\SimpleMazeFactory;
use Patterns\Creational\AbstractFactory\Maze\MazeFactories\MagicMazeFactory;
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
                        'expectedClass' => '\Maze\Map\SimpleMaze\Wall',
                    ),
                    array(
                        'method'        => 'makeRoom',
                        'arguments'     => array(0),
                        'expectedClass' => '\Maze\Map\SimpleMaze\Room',
                    ),
                    array(
                        'method'        => 'makeDoor',
                        'arguments'     => array(
                            SimpleMazeFactory::getInstance()->makeRoom(0),
                            SimpleMazeFactory::getInstance()->makeRoom(1)
                        ),
                        'expectedClass' => '\Maze\Map\SimpleMaze\Door',
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
                        'expectedClass' => '\Maze\Map\BombedMaze\BombedWall',
                    ),
                    array(
                        'method'        => 'makeRoom',
                        'arguments'     => array(0),
                        'expectedClass' => '\Maze\Map\BombedMaze\BombedRoom',
                    ),
                    array(
                        'method'        => 'makeDoor',
                        'arguments'     => array(
                            BombedMazeFactory::getInstance()->makeRoom(0),
                            BombedMazeFactory::getInstance()->makeRoom(1)
                        ),
                        'expectedClass' => '\Maze\Map\BombedMaze\BombedDoor',
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
                        'expectedClass' => 'Maze\Map\MagicMaze\MagicWall',
                    ),
                    array(
                        'method'        => 'makeRoom',
                        'arguments'     => array(0),
                        'expectedClass' => 'Maze\Map\MagicMaze\MagicRoom',
                    ),
                    array(
                        'method'        => 'makeDoor',
                        'arguments'     => array(
                            BombedMazeFactory::getInstance()->makeRoom(0),
                            BombedMazeFactory::getInstance()->makeRoom(1)
                        ),
                        'expectedClass' => 'Maze\Map\MagicMaze\MagicDoor',
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