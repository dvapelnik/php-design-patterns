<?php
namespace PatternsTests\Behavioral\Memento\Value;

use Patterns\Behavioral\Memento\Value\Value;
use PHPUnit_Framework_TestCase;
use ReflectionProperty;

class ValueTest extends PHPUnit_Framework_TestCase
{
    /** @var  ReflectionProperty */
    private $_reflectedValueProp;

    private $_value = 'f00';

    public function setUp()
    {
        $this->_reflectedValueProp = new ReflectionProperty(
            '\Patterns\Behavioral\Memento\Value\Value',
            '_value');
        $this->_reflectedValueProp->setAccessible(true);
    }

    public function testConstructor()
    {
        $valueObject = new Value($this->_value);

        $this->assertEquals($this->_value, $this->_reflectedValueProp->getValue($valueObject));

        return $valueObject;
    }

    /**
     * @depends testConstructor
     */
    public function testGetValue(Value $valueObject)
    {
        $this->assertEquals($this->_value, $valueObject->getValue());
    }

    /**
     * @depends testConstructor
     */
    public function testGetState(Value $valueObject)
    {
        $valueState = $valueObject->getState();

        $this->assertInstanceOf('\Patterns\Behavioral\Memento\Value\ValueState', $valueState);
    }

    /**
     * @depends testConstructor
     */
    public function testSetStateCorrect(Value $valueObject)
    {
        $valueStateOnBeginTest = $valueObject->getState();

        $this->_reflectedValueProp->setValue($valueObject, 'bar');
        $this->assertNotEquals($this->_value, $this->_reflectedValueProp->getValue($valueObject));

        $valueObject->setState($valueStateOnBeginTest);

        $this->assertEquals($this->_value, $this->_reflectedValueProp->getValue($valueObject));
    }

    /**
     * @depends testConstructor
     *
     * @expectedException \Patterns\Behavioral\Memento\Value\ValueStateException
     * @expectedExceptionMessage This state object not for given value-object
     */
    public function testSetStateWithException(Value $valueObject)
    {
        $valueStateOnBeginTest = $valueObject->getState();

        $newValueObject = new Value($this->_value);
        $newValueObject->setState($valueStateOnBeginTest);
    }
}