<?php
namespace Patterns\Creational\Prototype\MazeNativeClone;

use Maze\Maze as MazeOriginal;
use Patterns\Creational\Prototype\InitializeInterface;

class Maze extends MazeOriginal implements InitializeInterface
{
    public function initialize($options = array())
    {
    }
}