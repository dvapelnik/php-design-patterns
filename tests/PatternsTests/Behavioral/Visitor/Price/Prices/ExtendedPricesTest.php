<?php
namespace PatternsTests\Behavioral\Visitor\Price\Prices;

use PHPUnit_Framework_TestCase;
use ReflectionClass;

class ExtendedPrisesTest extends PHPUnit_Framework_TestCase
{
    public function extendedClassesProvider()
    {
        return array(
            array(
                'className'      => '\Patterns\Behavioral\Visitor\Price\Prices\DoorPrice',
                'expectedMethod' => 'visitDoorPrice',
            ),
            array(
                'className'      => '\Patterns\Behavioral\Visitor\Price\Prices\TablePrice',
                'expectedMethod' => 'visitTablePrice',
            ),
        );
    }

    /**
     * @dataProvider extendedClassesProvider
     *
     * @param $className
     * @param $expectedMethod
     */
    public function testAcceptVisitor($className, $expectedMethod)
    {
        $doorPrice = (new ReflectionClass($className))
            ->newInstanceWithoutConstructor();

        $abstractPriceVisitorMock =
            $this->getMockBuilder('\Patterns\Behavioral\Visitor\Price\PriceVisitors\AbstractPriceVisitor')
                ->disableOriginalConstructor()
                ->setMethods(array($expectedMethod))
                ->getMockForAbstractClass();

        $abstractPriceVisitorMock
            ->expects($this->once())
            ->method($expectedMethod)
            ->with($this->identicalTo($doorPrice));

        $doorPrice->acceptVisitor($abstractPriceVisitorMock);
    }
}