<?php
namespace Patterns\Creational\Prototype\MazeNativeClone\Map;

use Maze\Map\SimpleMaze\Wall as WallOriginal;
use Patterns\Creational\Prototype\InitializeInterface;

abstract class Wall extends WallOriginal implements InitializeInterface
{
    public function initialize($options = array())
    {
    }
}