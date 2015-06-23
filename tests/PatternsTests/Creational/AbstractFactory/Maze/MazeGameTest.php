<?php
namespace PatternsTests\Creational\AbstractFactory\Maze;

use Patterns\Creational\AbstractFactory\Maze\MazeFactories\BombedMazeFactory;
use Patterns\Creational\AbstractFactory\Maze\MazeFactories\MagicMazeFactory;
use Patterns\Creational\AbstractFactory\Maze\MazeFactories\SimpleMazeFactory;
use Patterns\Creational\AbstractFactory\Maze\MazeFactoryInterface;
use Patterns\Creational\AbstractFactory\Maze\MazeGame;
use PHPUnit_Framework_TestCase;

class MazeGameTest extends PHPUnit_Framework_TestCase
{
    /** @var  MazeGame */
    private $_mazeGame;

    public function setUp()
    {
        $this->_mazeGame = new MazeGame();
    }

    public function factoryProvider()
    {
        return array(
            array(SimpleMazeFactory::getInstance()),
            array(BombedMazeFactory::getInstance()),
            array(MagicMazeFactory::getInstance()),
        );
    }

    /**
     * @dataProvider factoryProvider
     *
     * @param MazeFactoryInterface $mazeFactory
     */
    public function testCreateMaze($mazeFactory)
    {
        $this->assertInstanceOf('\Maze\Maze', $this->_mazeGame->createMazeWithFactory($mazeFactory));
    }
}