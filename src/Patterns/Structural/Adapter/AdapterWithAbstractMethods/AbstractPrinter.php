<?php
namespace Patterns\Structural\Adapter\AdapterWithAbstractMethods;

abstract class AbstractPrinter implements StructurePrinterInterface
{
    public function getString()
    {
        $resultString = $this->_getHead();

        $resultString .= ' ' . sprintf("(%s)", implode(', ', $this->_getSlaves()));

        return $resultString;
    }

    protected abstract function _getHead();

    protected abstract function _getSlaves();
}