<?php
namespace PatternsTests\Behavioral\Memento\Value;

use Patterns\Behavioral\Memento\Value\Value;
use Patterns\Behavioral\Memento\Value\ValueState;
use PHPUnit_Framework_TestCase;
use ReflectionProperty;

class ValueStateTest extends PHPUnit_Framework_TestCase
{
    /** @var  ReflectionProperty */
    private $_reflectedOriginatorSplObjectHash;

    /** @var  ReflectionProperty */
    private $_reflectedOriginatorValue;

    private $_value = 'f00';

    public function setUp()
    {
        $this->_reflectedOriginatorSplObjectHash = new ReflectionProperty(
            '\Patterns\Behavioral\Memento\Value\ValueState',
            '_originatorSplObjectHash');
        $this->_reflectedOriginatorSplObjectHash->setAccessible(true);

        $this->_reflectedOriginatorValue = new ReflectionProperty(
            '\Patterns\Behavioral\Memento\Value\ValueState',
            '_originatorObjectValue');
        $this->_reflectedOriginatorValue->setAccessible(true);
    }

    public function testConstructor()
    {
        $value = new Value($this->_value);

        $valueState = new ValueState($value);

        $this->assertEquals(
            spl_object_hash($value),
            $this->_reflectedOriginatorSplObjectHash->getValue($valueState));

        $this->assertEquals(
            $this->_value,
            $this->_reflectedOriginatorValue->getValue($valueState));

        return array(
            'value'      => $value,
            'valueState' => $valueState,
        );
    }

    /**
     * @depends testConstructor
     */
    public function testGetValueCorrect($valuesArray)
    {
        /** @var Value $value */
        $value = $valuesArray['value'];

        /** @var ValueState $valueState */
        $valueState = $valuesArray['valueState'];

        $this->assertEquals($this->_value, $valueState->getValue($value));
    }

    /**
     * @depends testConstructor
     *
     * @expectedException \Patterns\Behavioral\Memento\Value\ValueStateException
     * @expectedExceptionMessage This state object not for given value-object
     */
    public function testGetValueWithException($valuesArray)
    {
        /** @var ValueState $valueState */
        $valueState = $valuesArray['valueState'];

        $valueState->getValue(new Value('bar'));
    }
}