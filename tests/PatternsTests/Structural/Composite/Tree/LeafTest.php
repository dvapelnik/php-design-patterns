<?php
namespace PatternsTests\Structural\Composite\Tree;

use Patterns\Structural\Composite\Tree\Abstracts\AbstractTreeItem;
use Patterns\Structural\Composite\Tree\Leaf;
use PHPUnit_Framework_TestCase;
use ReflectionClass;
use ReflectionMethod;
use ReflectionProperty;

class LeafTest extends PHPUnit_Framework_TestCase
{
    /** @var  AbstractTreeItem */
    private $_leaf;

    /** @var  ReflectionClass */
    private $_reflectedLeaf;

    /** @var  ReflectionMethod */
    private $_reflectedGetItemsMethod;

    /** @var ReflectionMethod */
    private $_reflectedGetValueMethod;

    /** @var  ReflectionProperty */
    private $_reflectedValueProperty;

    public function setUp()
    {
        $this->_leaf = new Leaf();

        $this->_reflectedLeaf = new ReflectionClass('\Patterns\Structural\Composite\Tree\Leaf');

        $this->_reflectedGetItemsMethod = $this->_reflectedLeaf->getMethod('_getItems');
        $this->_reflectedGetItemsMethod->setAccessible(true);

        $this->_reflectedGetValueMethod = $this->_reflectedLeaf->getMethod('_getValue');
        $this->_reflectedGetValueMethod->setAccessible(true);

        $this->_reflectedValueProperty = $this->_reflectedLeaf->getProperty('_value');
        $this->_reflectedValueProperty->setAccessible(true);
    }

    public function deltasProvider()
    {
        return array_map(function ($num) {
            return array($num);
        }, range(1, 4));
    }

    /**
     * @expectedException \Patterns\Structural\Composite\Tree\Exceptions\LeafHaveNotLeavesException
     */
    public function testGetItems()
    {
        $_items = $this->_reflectedGetItemsMethod->invoke($this->_leaf);
    }

    /**
     * @expectedException \Patterns\Structural\Composite\Tree\Exceptions\AddItemException
     * @expectedExceptionMessage Can't add item into leaf
     */
    public function testAddItem()
    {
        $this->_leaf->add(new Leaf());
    }

    /**
     * @expectedException \Patterns\Structural\Composite\Tree\Exceptions\RemoveItemException
     * @expectedExceptionMessage Can't remove item from leaf
     */
    public function testRemoveItem()
    {
        $this->_leaf->remove(new Leaf());
    }

    public function testGetValue()
    {
        $this->assertEquals(0, $this->_reflectedGetValueMethod->invoke($this->_leaf));
    }

    public function testGetValueNullToDefaultMechanism()
    {
        $this->assertNull($this->_reflectedValueProperty->getValue($this->_leaf));

        $_value = $this->_reflectedGetValueMethod->invoke($this->_leaf);

        $this->assertSame($_value, $this->_reflectedGetValueMethod->invoke($this->_leaf));
    }

    /**
     * @dataProvider deltasProvider
     */
    public function testIncrement($delta)
    {
        $_beginValue = $this->_reflectedValueProperty->getValue($this->_leaf);

        $this->_leaf->increment($delta);

        $_endValue = $this->_reflectedValueProperty->getValue($this->_leaf);

        $this->assertEquals($_beginValue + $delta, $_endValue);
    }

    /**
     * @dataProvider deltasProvider
     */
    public function testDecrement($delta)
    {
        $_beginValue = $this->_reflectedValueProperty->getValue($this->_leaf);

        $this->_leaf->decrement($delta);

        $_endValue = $this->_reflectedValueProperty->getValue($this->_leaf);

        $this->assertEquals($_beginValue - $delta, $_endValue);
    }

}