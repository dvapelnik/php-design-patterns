<?php
namespace Patterns\Behavioral\Iterator\ArrayIterator;

use Patterns\Behavioral\Iterator\IteratorInterface;

abstract class AbstractArrayIterator implements IteratorInterface
{
    protected $_array;

    protected $_currentIndex;

    /**
     * ArrayIterator constructor.
     */
    public function __construct($array)
    {
        $this->_array = array_values($array);
    }
}