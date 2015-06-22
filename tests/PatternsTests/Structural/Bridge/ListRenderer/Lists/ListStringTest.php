<?php
namespace PatternsTests\Structural\Bridge\ListRenderer\Lists;

use Patterns\Structural\Bridge\ListRenderer\Lists\ListString;
use PHPUnit_Framework_TestCase;
use ReflectionClass;

class ListStringTest extends PHPUnit_Framework_TestCase
{
    private $_items = array(0, 1, 2, 3, 4);

    public function testProcessItems()
    {
        $list = new ListString($this->_items);

        $reflectedListObject = new ReflectionClass('Patterns\Structural\Bridge\ListRenderer\Lists\ListString');
        $reflectedItemsProperty = $reflectedListObject->getProperty('_stringItems');
        $reflectedItemsProperty->setAccessible(true);

        $propertyValue = $reflectedItemsProperty->getValue($list);

        $this->assertNotNull($propertyValue);
        $this->assertTrue(is_string($propertyValue));
        $this->assertEquals('(0)-(1)-(2)-(3)-(4)', $propertyValue);
    }

    public function testGetItems()
    {
        $list = new ListString($this->_items);

        $this->assertEquals($this->_items, $list->getItems());
    }
}