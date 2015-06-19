<?php
namespace Patterns\Creational\Prototype\Maze\Map\SimpleMaze;

use Maze\Map\SimpleMaze\Wall as WallOriginal;
use Patterns\Creational\Prototype\CloneInterface;

class Wall extends WallOriginal implements CloneInterface
{

    public function makeClone()
    {
        return new static;
    }

    public function initialize($options = array())
    {
    }
}