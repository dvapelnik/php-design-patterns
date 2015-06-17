<?php
namespace Patterns\Creational\Builder\Maze\MazeBuilders;

use Maze\Map\BombedMaze\BombedDoor;
use Maze\Map\BombedMaze\BombedRoom;
use Patterns\Creational\Builder\Maze\MazeBuilder;

class BombedMazeBuilder extends MazeBuilder
{
    protected static $_classMap = array(
        'wall' => 'Maze\Map\BombedMaze\BombedWall',
        'room' => 'Maze\Map\BombedMaze\BombedRoom',
        'door' => 'Maze\Map\BombedMaze\BombedDoor',
    );
}