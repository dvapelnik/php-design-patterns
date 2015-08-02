<?php
namespace PatternsTests\Behavioral\Visitor\Price\Prices;

use PHPUnit_Framework_MockObject_MockObject;
use PHPUnit_Framework_TestCase;

class AbstractPriceTest extends PHPUnit_Framework_TestCase
{
    private $_priceValue = 10;

    private $_className = '\Patterns\Behavioral\Visitor\Price\Prices\AbstractPrice';

    public function testConstructor()
    {
        $abstractPriceMock =
            $this->getMockBuilder($this->_className)
                ->setConstructorArgs(array($this->_priceValue))
                ->getMockForAbstractClass();

        $this->assertAttributeEquals($this->_priceValue, '_price', $abstractPriceMock);

        return $abstractPriceMock;
    }

    /**
     * @depends testConstructor
     *
     * @param PHPUnit_Framework_MockObject_MockObject $abstractPriceMock
     */
    public function testGetPrice($abstractPriceMock)
    {
        $this->assertEquals($this->_priceValue, $abstractPriceMock->getPrice());
    }
}