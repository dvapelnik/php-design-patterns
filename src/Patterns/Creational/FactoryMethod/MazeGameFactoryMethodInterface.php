<?php
namespace Patterns\Creational\FactoryMethod;

interface MazeGameFactoryMethodInterface
{
    public function makeMaze();

    public function makeWall();

    public function makeRoom($num);

    public function makeDoor($room1, $room2);
}