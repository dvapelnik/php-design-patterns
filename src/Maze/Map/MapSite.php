<?php
namespace Maze\Map;

class MapSite implements MapSiteInterface
{
    const DIRECTION_NORTH = 0;
    const DIRECTION_EAST = 1;
    const DIRECTION_SOUTH = 2;
    const DIRECTION_WEST = 3;

    protected static $_directions = array(
        0 => 'North',
        1 => 'East',
        2 => 'South',
        3 => 'West',
    );

    public function Enter()
    {
        throw new MapSiteException('You must implement this method on inherited class');
    }

    public static function GetDirectionVerbose($direction)
    {
        return self::$_directions[$direction];
    }
}