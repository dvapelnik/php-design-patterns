<?php
namespace PatternsTests\Creational\Prototype\Maze;

use Maze\Map\MapSite;
use Patterns\Creational\AbstractFactory\Maze\MazeGame;
use Patterns\Creational\Prototype\Maze\MazePrototypeFactory;
use PHPUnit_Framework_TestCase;

class MazePrototypeFactoryTest extends PHPUnit_Framework_TestCase
{
    public function mazeGamesProvider()
    {
        return array(
            array(
                'doorDirections'  => array(
                    0 => MapSite::DIRECTION_EAST,
                    1 => MapSite::DIRECTION_WEST,
                ),
                'expectedClasses' => array(
                    'maze' => 'Patterns\Creational\Prototype\Maze\Maze',
                    'wall' => 'Patterns\Creational\Prototype\Maze\Map\SimpleMaze\Wall',
                    'room' => 'Patterns\Creational\Prototype\Maze\Map\SimpleMaze\Room',
                    'door' => 'Patterns\Creational\Prototype\Maze\Map\SimpleMaze\Door',
                )
            ),
            array(
                'doorDirections'  => array(
                    0 => MapSite::DIRECTION_EAST,
                    1 => MapSite::DIRECTION_WEST,
                ),
                'expectedClasses' => array(
                    'maze' => 'Patterns\Creational\Prototype\Maze\Maze',
                    'wall' => 'Patterns\Creational\Prototype\Maze\Map\BombedMaze\BombedWall',
                    'room' => 'Patterns\Creational\Prototype\Maze\Map\BombedMaze\BombedRoom',
                    'door' => 'Patterns\Creational\Prototype\Maze\Map\BombedMaze\BombedDoor',
                )
            ),
            array(
                'doorDirections'  => array(
                    0 => MapSite::DIRECTION_EAST,
                    1 => MapSite::DIRECTION_WEST,
                ),
                'expectedClasses' => array(
                    'maze' => 'Patterns\Creational\Prototype\Maze\Maze',
                    'wall' => 'Patterns\Creational\Prototype\Maze\Map\MagicMaze\MagicWall',
                    'room' => 'Patterns\Creational\Prototype\Maze\Map\MagicMaze\MagicRoom',
                    'door' => 'Patterns\Creational\Prototype\Maze\Map\MagicMaze\MagicDoor',
                )
            ),
            array(
                'doorDirections'  => array(
                    0 => MapSite::DIRECTION_EAST,
                    1 => MapSite::DIRECTION_WEST,
                ),
                'expectedClasses' => array(
                    'maze' => 'Patterns\Creational\Prototype\Maze\Maze',
                    'wall' => 'Patterns\Creational\Prototype\Maze\Map\SimpleMaze\Wall',
                    'room' => 'Patterns\Creational\Prototype\Maze\Map\BombedMaze\BombedRoom',
                    'door' => 'Patterns\Creational\Prototype\Maze\Map\MagicMaze\MagicDoor',
                )
            ),
        );
    }

    /**
     * @dataProvider mazeGamesProvider
     *
     * @param $doorDirections
     * @param $classes array
     */
    public function testMazeGameFactoryMethods($doorDirections, $classes)
    {
        $mazeGame = new MazeGame();

        $prototypeMaze = new $classes['maze'];
        $prototypeWall = new $classes['wall'];
        $prototypeRoom = new $classes['room'];
        $prototypeDoor = new $classes['door'];

        $maze = $mazeGame->createMazeWithFactory(new MazePrototypeFactory(
            $prototypeMaze, $prototypeWall, $prototypeRoom, $prototypeDoor
        ));

        $this->assertNotSame($prototypeMaze, $maze);

        $this->assertInstanceOf($classes['maze'], $maze);

        $doors = array();

        foreach (array_keys($doorDirections) as $num) {
            $room = $maze->getRoomByNum($num);
            $this->assertInstanceOf($classes['room'], $room);

            for ($i = 0; $i < 4; $i++) {
                if ($i != $doorDirections[$num]) {
                    $currentWallInCycle = $room->getSide($i);

                    $this->assertInstanceOf(
                        $classes['wall'], $currentWallInCycle);
                    $this->assertNotSame($prototypeWall, $currentWallInCycle);
                } else {
                    $currentDoorInCycle = $room->getSide($i);
                    $doors[$num] = $currentDoorInCycle;

                    $this->assertInstanceOf(
                        $classes['door'], $currentDoorInCycle);
                    $this->assertNotSame($prototypeDoor, $currentDoorInCycle);
                }
            }
        }

        $this->assertEquals($doors[0], $doors[1]);
    }
}