<?php
namespace Patterns\Behavioral\ChainOfResponsibility\HelpInfo\InheritImplementation;

abstract class AbstractHelpHandler
{
    protected $_helpData = 'Empty help data';

    protected $_hasHelpData = true;

    public function getHelpInfo()
    {
        return $this->_helpData;
    }
}