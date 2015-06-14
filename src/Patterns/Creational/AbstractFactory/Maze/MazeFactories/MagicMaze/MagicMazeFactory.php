<?php
namespace Patterns\Creational\AbstractFactory\Maze\MazeFactories\MagicMaze;

use Patterns\Creational\AbstractFactory\Maze\MazeFactory;

class MagicMazeFactory extends MazeFactory
{
    public function makeRoom($num)
    {
        return new MagicRoom($num);
    }

    public function makeWall()
    {
        return new MagicWall();
    }

    public function makeDoor($room1, $room2)
    {
        return new MagicDoor($room1, $room2);
    }

}