<?php
namespace PatternsTests\Behavioral\Iterator\ArrayIterator;

use Patterns\Behavioral\Iterator\ArrayIterator\ReverseArrayIterator;
use Patterns\Behavioral\Iterator\IteratorInterface;
use PHPUnit_Framework_TestCase;
use ReflectionProperty;

class ReverseArrayIteratorTest extends PHPUnit_Framework_TestCase
{
    /** @var  ReflectionProperty */
    private $_reflectedArrayProp;

    /** @var  ReflectionProperty */
    private $_reflectedCurrentIndexProp;

    /** @var  IteratorInterface */
    private $_iterator;

    /** @var  int[] */
    private $_array;

    private $_maxInArray = 9;

    public function setUp()
    {
        $this->_reflectedArrayProp = new ReflectionProperty(
            '\Patterns\Behavioral\Iterator\ArrayIterator\ReverseArrayIterator',
            '_array');
        $this->_reflectedArrayProp->setAccessible(true);

        $this->_reflectedCurrentIndexProp = new ReflectionProperty(
            '\Patterns\Behavioral\Iterator\ArrayIterator\ReverseArrayIterator',
            '_currentIndex');
        $this->_reflectedCurrentIndexProp->setAccessible(true);

        $this->_array = range(0, $this->_maxInArray);

        $this->_iterator = new ReverseArrayIterator($this->_array);
    }

    public function testAfterConstruct()
    {
        $iterator = new ReverseArrayIterator($this->_array);

        $this->assertNull($this->_reflectedCurrentIndexProp->getValue($iterator));
        $this->assertNotNull($this->_reflectedArrayProp->getValue($iterator));

        return $iterator;
    }

    /**
     * @depends testAfterConstruct
     */
    public function testFirst(IteratorInterface $iterator)
    {
        $iterator->first();

        $this->assertEquals(count($this->_array) - 1, $this->_reflectedCurrentIndexProp->getValue($iterator));

        return $iterator;
    }

    /**
     * @depends testFirst
     */
    public function testNextWithFirst(IteratorInterface $iterator)
    {
        $currentIndexBeforeInvokeNext = $this->_reflectedCurrentIndexProp->getValue($iterator);
        $iterator->next();
        $this->assertEquals(
            $currentIndexBeforeInvokeNext - 1,
            $this->_reflectedCurrentIndexProp->getValue($iterator));
    }

    public function testIsDone()
    {
        $this->_iterator->first();

        $this->assertFalse($this->_iterator->isDone());

        for ($i = 0; $i < count($this->_array); $i++) {
            $this->_iterator->next();
        }

        $this->assertTrue($this->_iterator->isDone());
    }

    public function testGetCurrentItem()
    {
        for ($i = count($this->_array) - 1, $this->_iterator->first();
             $i >= 0 && !$this->_iterator->isDone();
             $i--, $this->_iterator->next()) {
            $this->assertEquals($this->_array[$i], $this->_iterator->getCurrentItem());
        }
    }

    /**
     * @test
     */
    public function howItUse()
    {
        $i = count($this->_array) - 1;

        for ($this->_iterator->first(); !$this->_iterator->isDone(); $this->_iterator->next()) {
            $currentItem = $this->_iterator->getCurrentItem();

            $this->assertEquals($this->_array[$i], $currentItem);

            $i--;
        }
    }
}