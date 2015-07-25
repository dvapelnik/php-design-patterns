<?php
namespace PatternsTests\Behavioral\Iterator\ArrayIterator;

use PHPUnit_Framework_TestCase;
use ReflectionProperty;

class AbstractArrayIteratorTest extends PHPUnit_Framework_TestCase
{
    public function classProvider()
    {
        return array(
            array(
                'className' => '\Patterns\Behavioral\Iterator\ArrayIterator\ArrayIterator',
            ),
            array(
                'className' => '\Patterns\Behavioral\Iterator\ArrayIterator\ReverseArrayIterator',
            ),
        );
    }

    /**
     * @dataProvider classProvider
     */
    public function testConstructor($className)
    {
        $array = range(0, 9);

        $reflectedArrayProp = new ReflectionProperty($className, '_array');
        $reflectedArrayProp->setAccessible(true);

        $this->assertEquals($array, $reflectedArrayProp->getValue(new $className($array)));
    }

    /**
     * @dataProvider classProvider
     */
    public function testUsingArrayValues($className)
    {
        $inputArray = array(
            2 => 0,
            3 => 1,
            5 => 2,
        );

        $expectedArray = array(
            0 => 0,
            1 => 1,
            2 => 2,
        );

        $reflectedArrayProp = new ReflectionProperty($className, '_array');
        $reflectedArrayProp->setAccessible(true);

        $this->assertEquals(
            $expectedArray,
            $reflectedArrayProp->getValue(
                new $className($inputArray)));
    }
}