<?php
namespace Patterns\Creational\FactoryMethod\MazeGames;

use Maze\Map\BombedMaze\BombedDoor;
use Maze\Map\BombedMaze\BombedRoom;
use Maze\Map\BombedMaze\BombedWall;
use Patterns\Creational\FactoryMethod\MazeGame;

class BombedMazeGame extends MazeGame
{
    public function makeWall()
    {
        return new BombedWall();
    }

    public function makeRoom($num)
    {
        return new BombedRoom($num);
    }

    public function makeDoor($room1, $room2)
    {
        return new BombedDoor($room1, $room2);
    }

}