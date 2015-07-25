<?php
namespace Patterns\Behavioral\Iterator\ArrayIterator;

use Patterns\Behavioral\Iterator\IteratorInterface;

class ReverseArrayIterator extends AbstractArrayIterator
{
    public function first()
    {
        $this->_currentIndex = count($this->_array) - 1;
    }

    public function next()
    {
        $this->_currentIndex--;
    }

    public function isDone()
    {
        return $this->_currentIndex < 0;
    }

    public function getCurrentItem()
    {
        return $this->_array[$this->_currentIndex];
    }
}