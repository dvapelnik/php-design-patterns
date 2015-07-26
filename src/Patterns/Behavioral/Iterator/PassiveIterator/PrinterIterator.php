<?php
namespace Patterns\Behavioral\Iterator\PassiveIterator;

use Patterns\Behavioral\Iterator\IteratorInterface;
use Patterns\Behavioral\Iterator\PassiveIteratorInterface;

class PrinterIterator implements PassiveIteratorInterface
{
    private $_iterator;

    public function __construct(IteratorInterface $iterator)
    {
        $this->_iterator = $iterator;
    }

    public function traverse()
    {
        for ($this->_iterator->first(); !$this->_iterator->isDone(); $this->_iterator->next()) {
            echo $this->_iterator->getCurrentItem();
        }
    }
}