<?php
namespace PatternsTests\Structural\Composite\Tree;

use Patterns\Structural\Composite\Tree\Abstracts\AbstractTreeItem;
use Patterns\Structural\Composite\Tree\Leaf;
use Patterns\Structural\Composite\Tree\Node;
use PHPUnit_Framework_TestCase;
use ReflectionClass;
use ReflectionMethod;
use ReflectionProperty;

class NodeTest extends PHPUnit_Framework_TestCase
{
    /** @var  AbstractTreeItem */
    private $_node;

    /** @var  ReflectionClass */
    private $_reflectedNode;

    /** @var  ReflectionMethod */
    private $_reflectedGetItemsMethod;

    /** @var ReflectionMethod */
    private $_reflectedGetValueMethod;

    /** @var  ReflectionProperty */
    private $_reflectedItemsProperty;

    private $_classes = array(
        '\Patterns\Structural\Composite\Tree\Leaf',
        '\Patterns\Structural\Composite\Tree\Node'
    );

    public function setUp()
    {
        $this->_node = new Node();
        $this->_reflectedNode = new ReflectionClass(('\Patterns\Structural\Composite\Tree\Node'));

        $this->_reflectedGetItemsMethod = $this->_reflectedNode->getMethod('_getItems');
        $this->_reflectedGetItemsMethod->setAccessible(true);

        $this->_reflectedGetValueMethod = $this->_reflectedNode->getMethod('_getValue');
        $this->_reflectedGetValueMethod->setAccessible(true);

        $this->_reflectedItemsProperty = $this->_reflectedNode->getProperty('_items');
        $this->_reflectedItemsProperty->setAccessible(true);
    }

    public function deltasProvider()
    {
        return array_map(function ($num) {
            return array($num);
        }, range(1, 4));
    }

    public function itemClassesProvider()
    {
        return array_map(function ($_class) {
            return array($_class);
        }, $this->_classes);
    }

    public function itemClassCombinedPairsProvider()
    {
        $classPairs = array();

        foreach ($this->_classes as $_classOuter) {
            foreach ($this->_classes as $_classInner) {
                $classPairs[] = array($_classOuter, $_classInner);
            }
        }

        return $classPairs;
    }

    public function itemCountProvider()
    {
        return array_map(function () {
            return array(
                'countOfNodes'    => rand(0, 2),
                'countOfLeaves'   => rand(0, 4),
                'incrementsCount' => rand(0, 4),
                'incrementDelta'  => rand(1, 3),
            );
        }, range(0, 2));
    }

    public function testGetItems()
    {
        $_items = $this->_reflectedGetItemsMethod->invoke($this->_node);

        $this->assertEquals(array(), $_items);
    }

    public function testGetItemsNullToDefaultMechanism()
    {
        $this->assertNull($this->_reflectedItemsProperty->getValue($this->_node));

        $_items = $this->_reflectedGetItemsMethod->invoke($this->_node);

        $this->assertSame($_items, $this->_reflectedItemsProperty->getValue($this->_node));
    }

    /**
     * @dataProvider itemClassesProvider
     */
    public function testAddItem($addItemClass)
    {
        $addItem = new $addItemClass();

        $this->_node->add($addItem);

        $this->assertEquals(array($addItem), $this->_reflectedItemsProperty->getValue($this->_node));
    }

    /**
     * @dataProvider itemClassesProvider
     */
    public function testRemoveItem($itemClass)
    {
        $_item = new $itemClass();

        $this->_node->add($_item);
        $this->_node->remove($_item);

        $this->assertEquals(array(), $this->_reflectedItemsProperty->getValue($this->_node));
    }

    /**
     * @expectedException \Patterns\Structural\Composite\Tree\Exceptions\ItemNotFoundException
     * @expectedExceptionMessage Item not found
     *
     * @dataProvider itemClassCombinedPairsProvider
     */
    public function testRemoveNotAddedItem($classToAdd, $classToRemove)
    {
        $_leafAdded = new $classToAdd();
        $_leafNotAdded = new $classToRemove();

        $this->_node->add($_leafAdded);
        $this->_node->remove($_leafNotAdded);
    }

    /**
     * @expectedException \Patterns\Structural\Composite\Tree\Exceptions\ItemNotFoundException
     * @expectedExceptionMessage Item not found
     *
     * @dataProvider itemClassesProvider
     */
    public function testRemoveNotAddedItemWithEmptyItems($classToRemove)
    {
        $_leafNotAdded = new $classToRemove();

        $this->_node->remove($_leafNotAdded);
    }

    /**
     * @expectedException \Patterns\Structural\Composite\Tree\Exceptions\NodeHaveNotValueException
     */
    public function testGetValueWithoutLeaves()
    {
        $this->_reflectedGetValueMethod->invoke($this->_node);
    }

    /**
     * @dataProvider itemCountProvider
     */
    public function testGetValueWithLeaves(
        $countOfNodes,
        $countOfLeaves,
        $incrementsCount,
        $incrementDelta
    ) {
        for ($i = 0; $i < $countOfLeaves; $i++) {
            $this->_node->add(new Leaf());
        }

        for ($i = 0; $i < $incrementsCount; $i++) {
            $this->_node->increment($incrementDelta);
        }

        $this->assertEquals(
            $countOfLeaves * $incrementsCount * $incrementDelta,
            $this->_node->getValue(), implode(', ', func_get_args()));
    }

    /**
     * @dataProvider itemCountProvider
     */
    public function testGetValueWithNodesAndLeaves(
        $countOfNodes,
        $countOfLeaves,
        $incrementsCount,
        $incrementDelta
    ) {
        for ($i = 0; $i < $countOfNodes; $i++) {
            $_node = new Node();

            for ($j = 0; $j < $countOfLeaves; $j++) {
                $_node->add(new Leaf());
            }

            $this->_node->add($_node);
        }

        for ($i = 0; $i < $incrementsCount; $i++) {
            $this->_node->increment($incrementDelta);
        }

        $this->assertEquals(
            $countOfNodes * $countOfLeaves * $incrementsCount * $incrementDelta,
            $this->_node->getValue(), 'FAILS');
    }

    /**
     * @dataProvider deltasProvider
     */
    public function testIncrement($delta)
    {
        $_addedLeaf = new Leaf();

        $_reflectedAddedLeaf = new ReflectionClass('\Patterns\Structural\Composite\Tree\Leaf');
        $_reflectedValueProperty = $_reflectedAddedLeaf->getProperty('_value');
        $_reflectedValueProperty->setAccessible(true);

        $_beginValueOfAddedLeaf = $_reflectedValueProperty->getValue($_addedLeaf);

        $this->_node->add($_addedLeaf);
        $this->_node->increment($delta);

        $_endValueOfAddedLeaf = $_reflectedValueProperty->getValue($_addedLeaf);

        $this->assertEquals($_beginValueOfAddedLeaf + $delta, $_endValueOfAddedLeaf);
    }

    /**
     * @dataProvider deltasProvider
     */
    public function testDecrement($delta)
    {
        $_addedLeaf = new Leaf();

        $_reflectedAddedLeaf = new ReflectionClass('\Patterns\Structural\Composite\Tree\Leaf');
        $_reflectedValueProperty = $_reflectedAddedLeaf->getProperty('_value');
        $_reflectedValueProperty->setAccessible(true);

        $_beginValueOfAddedLeaf = $_reflectedValueProperty->getValue($_addedLeaf);

        $this->_node->add($_addedLeaf);
        $this->_node->decrement($delta);

        $_endValueOfAddedLeaf = $_reflectedValueProperty->getValue($_addedLeaf);

        $this->assertEquals($_beginValueOfAddedLeaf - $delta, $_endValueOfAddedLeaf);
    }
}