<?php
namespace MazeTests\Map;

use Maze\Map\MapSite;
use PHPUnit_Framework_TestCase;

class MapSiteTest extends PHPUnit_Framework_TestCase
{
    public function verboseDirectionsProvider()
    {
        return array(
            array(0, 'North'),
            array(1, 'East'),
            array(2, 'South'),
            array(3, 'West'),
        );
    }

    /**
     * @expectedException \Maze\Map\MapSiteException
     * @expectedExceptionMessage You must implement this method on inherited class
     */
    public function testConstructor()
    {
        $site = new MapSite();
        $site->Enter();
    }

    /**
     * @dataProvider verboseDirectionsProvider
     */
    public function testVerboseDirection($direction, $verboseDirection)
    {
        $this->assertEquals($verboseDirection, MapSite::GetDirectionVerbose($direction));
    }
}