<?php
namespace Patterns\Behavioral\TemplateMethod\Value;

class AbsoluteValue extends AbstractValue
{
    protected function _doSetValue($value)
    {
        $this->_value = abs($value);
    }
}