<?php
namespace PatternsTests\Creational\AbstractFactory\Maze;

use Patterns\Creational\AbstractFactory\Maze\MazeFactories\BombedMaze\BombedMazeFactory;
use Patterns\Creational\AbstractFactory\Maze\MazeFactories\SimpleMaze\SimpleMazeFactory;
use Patterns\Creational\AbstractFactory\Maze\MazeFactoryInterface;
use Patterns\Creational\AbstractFactory\Maze\MazeGame;
use PHPUnit_Framework_TestCase;

class MazeGameTest extends PHPUnit_Framework_TestCase
{
    public function factoryProvider()
    {
        return array(
            array(new SimpleMazeFactory()),
            array(new BombedMazeFactory()),
        );
    }

    /**
     * @dataProvider factoryProvider
     *
     * @param MazeFactoryInterface $mazeFactory
     */
    public function testCreateMaze($mazeFactory)
    {
        $this->assertInstanceOf('\Maze\Maze', MazeGame::CreateMaze($mazeFactory));
    }
}