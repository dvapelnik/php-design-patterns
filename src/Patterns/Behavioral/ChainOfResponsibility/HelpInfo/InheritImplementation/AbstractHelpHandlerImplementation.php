<?php
namespace Patterns\Behavioral\ChainOfResponsibility\HelpInfo\InheritImplementation;

abstract class AbstractHelpHandlerImplementation extends AbstractHelpHandler
{
    protected $_hasHelpData = false;

    public function getHelpInfo()
    {
        if ($this->_hasHelpData) {
            return $this->_helpData;
        } else {
            return parent::getHelpInfo();
        }
    }
}