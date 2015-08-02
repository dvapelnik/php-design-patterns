<?php
namespace PatternsTests\Behavioral\TemplateMethod\Value;

use Patterns\Behavioral\TemplateMethod\Value\Value;
use PHPUnit_Framework_TestCase;

class ValueTest extends PHPUnit_Framework_TestCase
{
    public function testDoSetValue()
    {
        $value = -2;

        $absoluteValue = new Value($value * 2);

        $this->assertAttributeEquals($value * 2, '_value', $absoluteValue);

        $reflectedDoSetValueMethod = new \ReflectionMethod(
            '\Patterns\Behavioral\TemplateMethod\Value\Value',
            '_doSetValue');
        $reflectedDoSetValueMethod->setAccessible(true);

        $reflectedDoSetValueMethod->invoke($absoluteValue, $value);

        $this->assertAttributeEquals($value, '_value', $absoluteValue);
    }
}