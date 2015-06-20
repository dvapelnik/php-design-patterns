<?php
namespace Maze\Map\SimpleMaze;

use Exception;
use Maze\Map\MapSite;
use Maze\Map\MapSiteException;

class Room extends MapSite
{
    protected $_roomNumber;
    protected $_sides = array();

    public function __construct($number = null)
    {
        if (null !== $number) {
            if (false === is_integer($number)) {
                throw new Exception('First argument should be a number');
            }

            $this->_roomNumber = $number;
        }
    }

    public function getSide($direction)
    {
        if (false === is_integer($direction)) {
            throw new Exception('Direction should be a number');
        }

        if ($direction < 0 || $direction > 3) {
            throw new MapSiteException("Direction should be in range: [0, 3]");
        }

        if (isset($this->_sides[$direction])) {
            return $this->_sides[$direction];
        } else {
            throw new MapSiteException("Room have not side on this direction: {$direction}");
        }
    }

    public function setSide($direction, MapSite $side)
    {
        if ($side instanceof Wall || $side instanceof Door) {
            $this->_sides[$direction] = $side;
        } else {
            throw new MapSiteException('Side should be an instance of Wall or Door');
        }

    }

    public function getRoomNumber()
    {
        return $this->_roomNumber;
    }
}