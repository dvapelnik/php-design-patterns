<?php
namespace Patterns\Creational\Builder\Maze;

interface MazeBuilderInterface
{
    public function buildMaze();

    public function buildRoom($num, $placeArray);

    public function buildDoor($roomNum1, $roomNum2);

    public function getMaze();
}