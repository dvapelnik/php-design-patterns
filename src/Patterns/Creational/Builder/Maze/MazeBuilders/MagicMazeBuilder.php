<?php
namespace Patterns\Creational\Builder\Maze\MazeBuilders;

use Patterns\Creational\Builder\Maze\MazeBuilder;

class MagicMazeBuilder extends MazeBuilder
{
    protected static $_classMap = array(
        'wall' => 'Maze\Map\MagicMaze\MagicWall',
        'room' => 'Maze\Map\MagicMaze\MagicRoom',
        'door' => 'Maze\Map\MagicMaze\MagicDoor',
    );
}