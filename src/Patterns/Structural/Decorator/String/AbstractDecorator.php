<?php
namespace Patterns\Structural\Decorator\String;

abstract class AbstractDecorator implements GetTextInterface
{
    protected $_getTextObject;

    public function __construct(GetTextInterface $getTextObject)
    {
        $this->_getTextObject = $getTextObject;
    }
}