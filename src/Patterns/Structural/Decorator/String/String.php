<?php
namespace Patterns\Structural\Decorator\String;

class String implements GetTextInterface
{
    private $_text;

    public function __construct($text)
    {
        $this->_text = $text;
    }

    public function getText()
    {
        return $this->_text;
    }
}