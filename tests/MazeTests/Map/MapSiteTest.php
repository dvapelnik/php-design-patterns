<?php
namespace MazeTests\Map;

use Maze\Map\MapSite;
use PHPUnit_Framework_TestCase;

class MapSiteTest extends PHPUnit_Framework_TestCase
{
    /**
     * @expectedException \Maze\Map\MapSiteException
     * @expectedExceptionMessage You must implement this method on inherited class
     */
    public function testConstructor()
    {
        $site = new MapSite();
        $site->Enter();
    }
}