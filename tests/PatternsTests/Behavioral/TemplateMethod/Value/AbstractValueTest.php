<?php
namespace PatternsTests\Behavioral\TemplateMethod\Value;

use PHPUnit_Framework_MockObject_MockObject;
use PHPUnit_Framework_TestCase;
use ReflectionClass;
use ReflectionProperty;

class AbstractValueTest extends PHPUnit_Framework_TestCase
{
    private $_value;
    /** @var  ReflectionProperty */
    private $_reflectedValueProp;

    public function setUp()
    {
        $this->_reflectedValueProp = new ReflectionProperty(
            '\Patterns\Behavioral\TemplateMethod\Value\AbstractValue',
            '_value');
        $this->_reflectedValueProp->setAccessible(true);

        $this->_value = 2;
    }

    public function testConstructor()
    {
        $className = '\Patterns\Behavioral\TemplateMethod\Value\AbstractValue';

        $mock = $this->getMockBuilder($className)
            ->setConstructorArgs(array($this->_value))
            ->setMethods(array('_doSetValue'))
            ->getMockForAbstractClass();

        $mock->expects($this->once())
            ->method('_doSetValue')
            ->with($this->equalTo($this->_value));

        $reflectedAbstractValueClass = new ReflectionClass($className);
        $reflectedAbstractValueConstructor = $reflectedAbstractValueClass->getConstructor();
        $reflectedAbstractValueConstructor->invoke($mock, $this->_value);

        $this->assertAttributeEquals(0, '_contOfSetValue', $mock);

        return $mock;
    }

    /**
     * @depends testConstructor
     *
     * @param $mock PHPUnit_Framework_MockObject_MockObject
     *
     * @return PHPUnit_Framework_MockObject_MockObject
     */
    public function testSetValue($mock)
    {
        $className = '\Patterns\Behavioral\TemplateMethod\Value\AbstractValue';

        $mock = $this->getMockBuilder($className)
            ->setConstructorArgs(array($this->_value))
            ->setMethods(array('_doSetValue'))
            ->getMockForAbstractClass();

        $mock->expects($this->once())
            ->method('_doSetValue')
            ->with($this->equalTo($this->_value * 2));

        $mock->setValue($this->_value * 2);

        $this->assertAttributeEquals(1, '_contOfSetValue', $mock);

        return $mock;
    }

    /**
     * @param $mock PHPUnit_Framework_MockObject_MockObject
     *
     * @depends testSetValue
     */
    public function testGetValue($mock)
    {
        $this->assertNull($mock->getValue());
    }

    /**
     * @param $mock PHPUnit_Framework_MockObject_MockObject
     *
     * @depends testSetValue
     */
    public function testGetCountOfSetValue($mock)
    {
        $this->assertEquals(1, $mock->getCountOfSetValue());
    }
}