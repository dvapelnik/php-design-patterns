<?php
namespace PatternsTests\Behavioral\TemplateMethod\Value;

use PHPUnit_Framework_MockObject_MockObject;
use PHPUnit_Framework_TestCase;
use ReflectionClass;
use ReflectionProperty;

class AbstractValueTest extends PHPUnit_Framework_TestCase
{
    private $className = '\Patterns\Behavioral\TemplateMethod\Value\AbstractValue';

    private $_value;
    /** @var  ReflectionProperty */
    private $_reflectedValueProp;

    public function setUp()
    {
        $this->_reflectedValueProp = new ReflectionProperty(
            $this->className,
            '_value'
        );
        $this->_reflectedValueProp->setAccessible(true);

        $this->_value = 2;
    }

    public function testConstructor()
    {
        $mock = $this->makeMock();

        $mock->expects($this->once())
            ->method('_doSetValue')
            ->with($this->equalTo($this->_value));

        $reflectedAbstractValueClass = new ReflectionClass($this->className);
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
        $mock = $this->makeMock();

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

    private function makeMock()
    {
        $mock = $this->getMockBuilder($this->className)
            ->setConstructorArgs(array($this->_value))
            ->setMethods(array('_doSetValue'))
            ->getMockForAbstractClass();

        return $mock;
    }
}