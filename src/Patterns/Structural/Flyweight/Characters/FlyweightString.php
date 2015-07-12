<?php
namespace Patterns\Structural\Flyweight\Characters;

class FlyweightString implements FlyweightInterface
{
    /** @var FlyweightInterface[] */
    private $_words;

    public function __construct($string, FlyweightFactory $flyweightFactory)
    {
        $this->_words = array();

        foreach (preg_split('/\s+/', $string) as $word) {
            $this->_words[] = $flyweightFactory->getFlyweight($word);
        }
    }

    public function getString()
    {
        return implode(' ', array_map(function (FlyweightInterface $flyItem) {
            return $flyItem->getString();
        }, $this->_words));
    }
}