<?php
namespace Patterns\Behavioral\Iterator\ArrayIterator;

class ArrayIterator extends AbstractArrayIterator
{
    public function first()
    {
        $this->_currentIndex = 0;
    }

    public function next()
    {
        $this->_currentIndex++;
    }

    public function isDone()
    {
        return $this->_currentIndex > count($this->_array) - 1;
    }

    public function getCurrentItem()
    {
        return $this->_array[$this->_currentIndex];
    }
}