<?php
namespace PatternsTests\Behavioral\TemplateMethod\Value;

use Patterns\Behavioral\TemplateMethod\Value\AbsoluteValue;
use PHPUnit_Framework_TestCase;

class AbsoluteValueTest extends PHPUnit_Framework_TestCase
{
    public function testDoSetValue()
    {
        $value = -2;

        $absoluteValue = new AbsoluteValue($value * 2);

        $this->assertAttributeEquals(abs($value * 2), '_value', $absoluteValue);

        $reflectedDoSetValueMethod = new \ReflectionMethod(
            '\Patterns\Behavioral\TemplateMethod\Value\AbsoluteValue',
            '_doSetValue');
        $reflectedDoSetValueMethod->setAccessible(true);

        $reflectedDoSetValueMethod->invoke($absoluteValue, $value);

        $this->assertAttributeEquals(abs($value), '_value', $absoluteValue);
    }
}