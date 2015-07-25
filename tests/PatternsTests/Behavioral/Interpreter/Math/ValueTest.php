<?php
namespace PatternsTests\Behavioral\Interpreter\Math;

use Patterns\Behavioral\Interpreter\Math\ExpressionImplementations\Value;
use PHPUnit_Framework_TestCase;
use ReflectionProperty;

class ValueTest extends PHPUnit_Framework_TestCase
{
    public function numProvider()
    {
        return array(
            array(-1),
            array(0),
            array(1),
        );
    }

    /**
     * @dataProvider numProvider
     */
    public function testConstructor($num)
    {
        $value = new Value($num);

        $valueProp = new ReflectionProperty(
            '\Patterns\Behavioral\Interpreter\Math\ExpressionImplementations\Value',
            '_value');
        $valueProp->setAccessible(true);

        $this->assertEquals($num, $valueProp->getValue($value));
    }

    /**
     * @dataProvider numProvider
     */
    public function testEvaluate($num)
    {
        $this->assertEquals($num, (new Value($num))->evaluate());
    }
}