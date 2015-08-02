<?php
namespace Patterns\Behavioral\TemplateMethod\Value;

abstract class AbstractValue
{
    protected $_value;

    protected $_contOfSetValue;

    /**
     * AbstractValue constructor.
     *
     * @param $_value
     */
    public function __construct($_value)
    {
        $this->_contOfSetValue = 0;

        $this->_doSetValue($_value);
    }

    /**
     * @param mixed $value
     */
    public function setValue($value)
    {
        $this->_contOfSetValue++;

        $this->_doSetValue($value);
    }

    abstract protected function _doSetValue($value);

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->_value;
    }

    /**
     * @return mixed
     */
    public function getCountOfSetValue()
    {
        return $this->_contOfSetValue;
    }
}