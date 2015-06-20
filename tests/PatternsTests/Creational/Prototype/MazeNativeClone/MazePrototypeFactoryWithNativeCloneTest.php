<?php
namespace PatternsTests\Creational\Prototype\MazeNativeClone;

use Maze\Map\MapSite;
use Patterns\Creational\AbstractFactory\Maze\MazeGame;
use Patterns\Creational\Prototype\Maze\MazePrototypeFactory;
use Patterns\Creational\Prototype\MazeNativeClone\MazePrototypeFactoryWithNativeClone;

class MazePrototypeFactoryWithNativeCloneTest extends \PHPUnit_Framework_TestCase
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
                    'maze' => 'Patterns\Creational\Prototype\MazeNativeClone\Maze',
                    'wall' => 'Patterns\Creational\Prototype\MazeNativeClone\Map\SimpleMaze\Wall',
                    'room' => 'Patterns\Creational\Prototype\MazeNativeClone\Map\SimpleMaze\Room',
                    'door' => 'Patterns\Creational\Prototype\MazeNativeClone\Map\SimpleMaze\Door',
                )
            ),
            array(
                'doorDirections'  => array(
                    0 => MapSite::DIRECTION_EAST,
                    1 => MapSite::DIRECTION_WEST,
                ),
                'expectedClasses' => array(
                    'maze' => 'Patterns\Creational\Prototype\MazeNativeClone\Maze',
                    'wall' => 'Patterns\Creational\Prototype\MazeNativeClone\Map\BombedMaze\BombedWall',
                    'room' => 'Patterns\Creational\Prototype\MazeNativeClone\Map\BombedMaze\BombedRoom',
                    'door' => 'Patterns\Creational\Prototype\MazeNativeClone\Map\BombedMaze\BombedDoor',
                )
            ),
            array(
                'doorDirections'  => array(
                    0 => MapSite::DIRECTION_EAST,
                    1 => MapSite::DIRECTION_WEST,
                ),
                'expectedClasses' => array(
                    'maze' => 'Patterns\Creational\Prototype\MazeNativeClone\Maze',
                    'wall' => 'Patterns\Creational\Prototype\MazeNativeClone\Map\MagicMaze\MagicWall',
                    'room' => 'Patterns\Creational\Prototype\MazeNativeClone\Map\MagicMaze\MagicRoom',
                    'door' => 'Patterns\Creational\Prototype\MazeNativeClone\Map\MagicMaze\MagicDoor',
                )
            ),
            array(
                'doorDirections'  => array(
                    0 => MapSite::DIRECTION_EAST,
                    1 => MapSite::DIRECTION_WEST,
                ),
                'expectedClasses' => array(
                    'maze' => 'Patterns\Creational\Prototype\MazeNativeClone\Maze',
                    'wall' => 'Patterns\Creational\Prototype\MazeNativeClone\Map\SimpleMaze\Wall',
                    'room' => 'Patterns\Creational\Prototype\MazeNativeClone\Map\BombedMaze\BombedRoom',
                    'door' => 'Patterns\Creational\Prototype\MazeNativeClone\Map\MagicMaze\MagicDoor',
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

        $mazePrototype = new $classes['maze'];
        $wallPrototype = new $classes['wall'];
        $roomPrototype = new $classes['room'];
        $doorPrototype = new $classes['door'];

        $maze = $mazeGame->createMaze(new MazePrototypeFactoryWithNativeClone(
            $mazePrototype,
            $wallPrototype,
            $roomPrototype,
            $doorPrototype
        ));

        $this->assertInstanceOf($classes['maze'], $maze);
        $this->assertNotEquals($mazePrototype, $maze);

        $doors = array();

        foreach (array_keys($doorDirections) as $num) {
            $room = $maze->getRoomByNum($num);
            $this->assertInstanceOf($classes['room'], $room);

            for ($i = 0; $i < 4; $i++) {
                if ($i != $doorDirections[$num]) {
                    $currentWallInCycle = $room->getSide($i);

                    $this->assertInstanceOf(
                        $classes['wall'], $currentWallInCycle);

                    $this->assertNotSame($wallPrototype, $currentWallInCycle);
                } else {
                    $currentDoorInCycle = $room->getSide($i);
                    $doors[$num] = $currentDoorInCycle;

                    $this->assertInstanceOf(
                        $classes['door'], $doors[$num] = $currentDoorInCycle);
                    $this->assertNotSame($doorPrototype, $currentDoorInCycle);
                }
            }
        }

        $this->assertEquals($doors[0], $doors[1]);
    }
}