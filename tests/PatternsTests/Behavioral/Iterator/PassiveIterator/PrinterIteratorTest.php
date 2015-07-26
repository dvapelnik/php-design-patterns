<?php
namespace PatternsTests\Behavioral\Iterator\PassiveIterator;

use Patterns\Behavioral\Iterator\ArrayIterator\ArrayIterator;
use Patterns\Behavioral\Iterator\PassiveIterator\PrinterIterator;
use PHPUnit_Framework_TestCase;
use ReflectionProperty;

class PrinterIteratorTest extends PHPUnit_Framework_TestCase
{
    /** @var  ReflectionProperty */
    private $_reflectedIteratorProp;

    private $_array;

    public function setUp()
    {
        $this->_reflectedIteratorProp = new ReflectionProperty(
            '\Patterns\Behavioral\Iterator\PassiveIterator\PrinterIterator',
            '_iterator');
        $this->_reflectedIteratorProp->setAccessible(true);

        $this->_array = range(0, 9);
    }

    public function testConstructor()
    {
        $innerIterator = new ArrayIterator($this->_array);

        $iterator = new PrinterIterator($innerIterator);

        $this->assertSame($innerIterator, $this->_reflectedIteratorProp->getValue($iterator));

        return $iterator;
    }

    /**
     * @depends testConstructor
     */
    public function testTraverse(PrinterIterator $iterator)
    {
        $iterator->traverse();

        $this->expectOutputString(implode('', $this->_array));
    }
}