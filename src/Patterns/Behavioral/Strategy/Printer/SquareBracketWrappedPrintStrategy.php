<?php
namespace Patterns\Behavioral\Strategy\Printer;

class SquareBracketWrappedPrintStrategy extends AbstractPrintStrategy
{
    protected $_printPattern = '[%s]';
}