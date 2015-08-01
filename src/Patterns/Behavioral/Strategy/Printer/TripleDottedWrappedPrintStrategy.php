<?php
namespace Patterns\Behavioral\Strategy\Printer;

class TripleDottedWrappedPrintStrategy extends AbstractPrintStrategy
{
    protected $_printPattern = '...%s...';
}