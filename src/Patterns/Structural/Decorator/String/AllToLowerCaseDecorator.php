<?php
namespace Patterns\Structural\Decorator\String;

class AllToLowerCaseDecorator extends AbstractDecorator
{
    public function getText()
    {
        return strtolower($this->_getTextObject->getText());
    }
}