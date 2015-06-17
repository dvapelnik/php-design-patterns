<?php
namespace Patterns\Creational\Builder\Maze\MazeBuilders;

use Patterns\Creational\Builder\Maze\MazeBuilder;

class SimpleMazeBuilder extends MazeBuilder
{
    protected static $_classMap = array(
        'wall' => 'Maze\Map\SimpleMaze\Wall',
        'room' => 'Maze\Map\SimpleMaze\Room',
        'door' => 'Maze\Map\SimpleMaze\Door',
    );
}