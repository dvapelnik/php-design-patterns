<?php
namespace Patterns\Structural\Flyweight\Characters;

use Patterns\Creational\Singleton\Singleton;

class FlyweightFactory extends Singleton
{
    private $_flyweights;

    public function getFlyweight($string)
    {
        if ($this->_flyweights === null) {
            $this->_flyweights = array();
        }

        if (!isset($this->_flyweights[$string])) {
            if (strlen($string) == 1) {
                $this->_flyweights[$string] = new FlyweightCharacter($string);
            } elseif (preg_match('/\s/', $string)) {
                $this->_flyweights[$string] = new FlyweightString($string, $this);
            } else {
                $this->_flyweights[$string] = new FlyweightWord($string, $this);
            }
        }

        return $this->_flyweights[$string];
    }
}