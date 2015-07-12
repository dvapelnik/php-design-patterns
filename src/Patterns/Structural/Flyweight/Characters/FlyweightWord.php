<?php
namespace Patterns\Structural\Flyweight\Characters;

class FlyweightWord implements FlyweightInterface
{
    /** @var FlyweightCharacter[] */
    private $_characters;

    /**
     * @param $word
     * @param $flyweightFactory FlyweightFactory
     */
    public function __construct($word, $flyweightFactory)
    {
        $this->_characters = array();

        for ($i = 0; $i < strlen($word); $i++) {
            $this->_characters[] = $flyweightFactory->getFlyweight($word[$i]);
        }
    }

    public function getString()
    {
        $result = '';

        foreach ($this->_characters as $char) {
            $result .= $char->getString();
        }

        return $result;
    }
}