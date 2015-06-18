<?php
namespace PatternsTests\Creational\FactoryMethod\Maze;

use Maze\Map\MapSite;
use Patterns\Creational\FactoryMethod\MazeGame;
use Patterns\Creational\FactoryMethod\MazeGames\BombedMazeGame;
use Patterns\Creational\FactoryMethod\MazeGames\MagicMazeGame;
use Patterns\Creational\FactoryMethod\MazeGames\SimpleMazeGame;
use PHPUnit_Framework_TestCase;

class MazeGamesTest extends PHPUnit_Framework_TestCase
{
    public function mazeGamesProvider()
    {
        return array(
            array(
                'mazeGame'        => new SimpleMazeGame(),
                'doorDirections'  => array(
                    0 => MapSite::DIRECTION_EAST,
                    1 => MapSite::DIRECTION_WEST,
                ),
                'expectedClasses' => array(
                    'maze' => '\Maze\Maze',
                    'wall' => '\Maze\Map\SimpleMaze\Wall',
                    'room' => '\Maze\Map\SimpleMaze\Room',
                    'door' => '\Maze\Map\SimpleMaze\Door',
                )
            ),
            array(
                'mazeGame'        => new BombedMazeGame(),
                'doorDirections'  => array(
                    0 => MapSite::DIRECTION_EAST,
                    1 => MapSite::DIRECTION_WEST,
                ),
                'expectedClasses' => array(
                    'maze' => '\Maze\Maze',
                    'wall' => '\Maze\Map\BombedMaze\BombedWall',
                    'room' => '\Maze\Map\BombedMaze\BombedRoom',
                    'door' => '\Maze\Map\BombedMaze\BombedDoor',
                )
            ),
            array(
                'mazeGame'        => new MagicMazeGame(),
                'doorDirections'  => array(
                    0 => MapSite::DIRECTION_EAST,
                    1 => MapSite::DIRECTION_WEST,
                ),
                'expectedClasses' => array(
                    'maze' => '\Maze\Maze',
                    'wall' => '\Maze\Map\MagicMaze\MagicWall',
                    'room' => '\Maze\Map\MagicMaze\MagicRoom',
                    'door' => '\Maze\Map\MagicMaze\MagicDoor',
                )
            ),
        );
    }

    /**
     * @dataProvider mazeGamesProvider
     *
     * @param $mazeGame MazeGame
     * @param $doorDirections
     * @param $expectedClasses array
     */
    public function testMazeGameFactoryMethods($mazeGame, $doorDirections, $expectedClasses)
    {
        $maze = $mazeGame->createMaze();

        $this->assertInstanceOf($expectedClasses['maze'], $maze);

        $doors = array();

        foreach (array_keys($doorDirections) as $num) {
            $room = $maze->getRoomByNum($num);
            $this->assertInstanceOf($expectedClasses['room'], $room);

            for ($i = 0; $i < 4; $i++) {
                if ($i != $doorDirections[$num]) {
                    $this->assertInstanceOf(
                        $expectedClasses['wall'], $room->getSide($i));
                } else {
                    $this->assertInstanceOf(
                        $expectedClasses['door'], $doors[$num] = $room->getSide($i));
                }
            }
        }

        $this->assertEquals($doors[0], $doors[1]);
    }
}