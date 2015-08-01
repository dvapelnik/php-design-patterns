<?php
namespace Patterns\Behavioral\Strategy\Printer;

abstract class AbstractPrintStrategy
{
    protected $_printPattern;

    public function getFormattedString($string)
    {
        if ($this->_printPattern === null) {
            throw new \Exception("'_printPattern' should be reassign with not-null value on extended class");
        }

        return sprintf($this->_printPattern, $string);
    }
}