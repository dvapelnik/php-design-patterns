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

        $maze = $mazeGame->createMaze(new MazePrototypeFactory(
            new $classes['maze'],
            new $classes['wall'],
            new $classes['room'](0),
            new $classes['door'](new $classes['room'](0), new $classes['room'](1))
        ));

        $this->assertInstanceOf($classes['maze'], $maze);

        $doors = array();

        foreach (array_keys($doorDirections) as $num) {
            $room = $maze->getRoomByNum($num);
            $this->assertInstanceOf($classes['room'], $room);

            for ($i = 0; $i < 4; $i++) {
                if ($i != $doorDirections[$num]) {
                    $this->assertInstanceOf(
                        $classes['wall'], $room->getSide($i));
                } else {
                    $this->assertInstanceOf(
                        $classes['door'], $doors[$num] = $room->getSide($i));
                }
            }
        }

        $this->assertEquals($doors[0], $doors[1]);
    }
}