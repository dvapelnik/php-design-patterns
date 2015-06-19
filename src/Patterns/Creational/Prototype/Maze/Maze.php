<?php
namespace Patterns\Creational\Prototype\Maze;

use Maze\Maze as MazeOriginal;
use Patterns\Creational\Prototype\CloneInterface;

class Maze extends MazeOriginal implements CloneInterface
{

    public function makeClone()
    {
        return new static;
    }

    public function initialize($options = array())
    {
    }
}