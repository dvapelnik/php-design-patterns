<?php
namespace PatternsTests\Structural\Bridge\ListRenderer\Lists;

use Patterns\Structural\Bridge\ListRenderer\Lists\ListArray;
use PHPUnit_Framework_TestCase;
use ReflectionClass;

class ListArrayTest extends PHPUnit_Framework_TestCase
{
    private $_items = array(0, 1, 2, 3, 4);

    public function testProcessItems()
    {
        $list = new ListArray($this->_items);

        $reflectedListObject = new ReflectionClass('Patterns\Structural\Bridge\ListRenderer\Lists\ListArray');
        $reflectedItemsProperty = $reflectedListObject->getProperty('_items');
        $reflectedItemsProperty->setAccessible(true);

        $propertyValue = $reflectedItemsProperty->getValue($list);

        $this->assertNotNull($propertyValue);
        $this->assertTrue(is_array($propertyValue));
        $this->assertEquals($this->_items, $propertyValue);
        $this->assertSame($this->_items, $propertyValue);
    }

    public function testGetItems()
    {
        $list = new ListArray($this->_items);

        $this->assertEquals($this->_items, $list->getItems());
    }
}