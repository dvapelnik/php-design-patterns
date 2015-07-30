<?php
namespace Patterns\Behavioral\Memento\Value;

use Exception;

class Value
{
    private $_value;

    /**
     * Value constructor.
     *
     * @param $_value
     */
    public function __construct($_value)
    {
        $this->_value = $_value;
    }

    public function getState()
    {
        return new ValueState($this);
    }

    /**
     * @param ValueState $state
     *
     * @throws ValueStateException
     * @throws Exception
     */
    public function setState(ValueState $state)
    {
        try {
            $this->_value = $state->getValue($this);
        } catch(ValueStateException $e) {
            throw $e;
        }
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->_value;
    }
}