<?php
namespace Patterns\Behavioral\TemplateMethod\Value;

class Value extends AbstractValue
{
    protected function _doSetValue($value)
    {
        $this->_value = $value;
    }
}