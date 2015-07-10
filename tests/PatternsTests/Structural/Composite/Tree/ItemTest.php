<?php
namespace PatternsTests\Structural\Composite\Tree;

use Patterns\Structural\Composite\Tree\Abstracts\AbstractTreeItem;
use PHPUnit_Framework_TestCase;
use ReflectionMethod;

class ItemTest extends PHPUnit_Framework_TestCase
{
    private $_classes = array(
        '\Patterns\Structural\Composite\Tree\Leaf',
        '\Patterns\Structural\Composite\Tree\Node'
    );

    public function itemClassesProvider()
    {
        return array_map(function ($class) {
            return array($class);
        }, $this->_classes);
    }

    /**
     * @expectedException \Patterns\Structural\Composite\Tree\Exceptions\IncrementValueException
     * @expectedExceptionMessage Delta cannot be negative.
     *
     * @dataProvider itemClassesProvider
     */
    public function testIncrementWithNegativeDelta($itemClass)
    {
        /** @var AbstractTreeItem $_item */
        $_item = new $itemClass();
        $_item->increment(-1);
    }

    /**
     * @expectedException \Patterns\Structural\Composite\Tree\Exceptions\IncrementValueException
     * @expectedExceptionMessage Delta cannot be zero.
     *
     * @dataProvider itemClassesProvider
     */
    public function testIncrementWithZeroDelta($itemClass)
    {
        /** @var AbstractTreeItem $_item */
        $_item = new $itemClass();
        $_item->increment(0);
    }

    /**
     * @expectedException \Patterns\Structural\Composite\Tree\Exceptions\DecrementValueException
     * @expectedExceptionMessage Delta cannot be negative.
     *
     * @dataProvider itemClassesProvider
     */
    public function testDecrementWithNegativeDelta($itemClass)
    {
        /** @var AbstractTreeItem $_item */
        $_item = new $itemClass();
        $_item->decrement(-11);
    }

    /**
     * @expectedException \Patterns\Structural\Composite\Tree\Exceptions\DecrementValueException
     * @expectedExceptionMessage Delta cannot be zero.
     *
     * @dataProvider itemClassesProvider
     */
    public function testDecrementWithZeroDelta($itemClass)
    {
        /** @var AbstractTreeItem $_item */
        $_item = new $itemClass();
        $_item->decrement(0);
    }

    public function testValidateDelta()
    {
        $_reflectedValidateDelta = new ReflectionMethod(
            '\Patterns\Structural\Composite\Tree\Abstracts\AbstractTreeItem',
            '_validateDelta');

        $_reflectedValidateDelta->setAccessible(true);

        $this->setExpectedException(
            '\Patterns\Structural\Composite\Tree\Exceptions\ChangeValueException',
            'Delta cannot be negative.');

        $_reflectedValidateDelta->invoke(null, -1);

        $this->setExpectedException(
            '\Patterns\Structural\Composite\Tree\Exceptions\ChangeValueException',
            'Delta cannot be zero.');

        $_reflectedValidateDelta->invoke(null, 0);
    }
}