<?php
namespace Patterns\Structural\Flyweight\Characters;

class FlyweightCharacter implements FlyweightInterface
{
    private $_char;

    public function __construct($char)
    {
        $this->_char = $char;
    }

    public function getString()
    {
        return $this->_char;
    }
}