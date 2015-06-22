<?php
namespace PatternsTests\Structural\Bridge\ListRenderer\Lists;

use Patterns\Structural\Bridge\ListRenderer\Lists\ListInterface;
use PHPUnit_Framework_TestCase;
use ReflectionClass;

class ListsTests extends PHPUnit_Framework_TestCase
{
    public function classesProvider()
    {
        return array(
            array('class' => 'Patterns\Structural\Bridge\ListRenderer\Lists\ListArray'),
            array('class' => 'Patterns\Structural\Bridge\ListRenderer\Lists\ListString'),
        );
    }

    /**
     * @dataProvider classesProvider
     */
    public function testRendererAfterConstruct($class)
    {
        $list = new $class(range(0, 5));

        $reflectedListObject = new ReflectionClass($class);
        $reflectedItemsProperty = $reflectedListObject->getProperty('_renderer');
        $reflectedItemsProperty->setAccessible(true);

        $this->assertNotNull($reflectedItemsProperty->getValue($list));
    }
}