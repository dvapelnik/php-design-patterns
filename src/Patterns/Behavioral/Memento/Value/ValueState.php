<?php
namespace Patterns\Behavioral\Memento\Value;

class ValueState
{
    private $_originatorSplObjectHash;

    private $_originatorObjectValue;

    /**
     * ValueState constructor.
     *
     * @param Value $value
     */
    public function __construct(Value $value)
    {
        $this->_originatorSplObjectHash = spl_object_hash($value);
        $this->_originatorObjectValue = $value->getValue();
    }

    /**
     * @param Value $value
     *
     * @return mixed
     * @throws ValueStateException
     */
    public function getValue(Value $value)
    {
        if ($this->_originatorSplObjectHash == spl_object_hash($value)) {
            return $this->_originatorObjectValue;
        } else {
            throw new ValueStateException('This state object not for given value-object');
        }
    }
}