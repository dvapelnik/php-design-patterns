<?php
use Patterns\Creational\AbstractFactory\Maze\MazeFactories\SimpleMazeFactory;
use Patterns\Creational\AbstractFactory\Maze\MazeGame;

require_once('../vendor/autoload.php');


$simpleFactory = new SimpleMazeFactory();

$maze = MazeGame::CreateMaze($simpleFactory);

var_dump($maze);