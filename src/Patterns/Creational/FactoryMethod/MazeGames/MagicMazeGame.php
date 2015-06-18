<?php
namespace Patterns\Creational\FactoryMethod\MazeGames;

use Maze\Map\MagicMaze\MagicDoor;
use Maze\Map\MagicMaze\MagicRoom;
use Maze\Map\MagicMaze\MagicWall;
use Patterns\Creational\FactoryMethod\MazeGame;

class MagicMazeGame extends MazeGame
{
    public function makeWall()
    {
        return new MagicWall();
    }

    public function makeRoom($num)
    {
        return new MagicRoom($num);
    }

    public function makeDoor($room1, $room2)
    {
        return new MagicDoor($room1, $room2);
    }

}