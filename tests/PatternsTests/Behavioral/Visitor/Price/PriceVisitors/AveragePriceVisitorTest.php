<?php
namespace PatternsTests\Behavioral\Visitor\Price\PriceVisitors;

use Patterns\Behavioral\Visitor\Price\PriceVisitors\AveragePriceVisitor;
use PHPUnit_Framework_TestCase;

class AveragePriceVisitorTest extends PHPUnit_Framework_TestCase
{
    private $_priceValues = array(
        'prices'       => array(2, 4),
        'averagePrice' => 3,
    );

    public function testVisitTablePrice()
    {
        $averagePriceVisitor = new AveragePriceVisitor();

        $expectedArray = array();

        foreach ($this->_priceValues['prices'] as $priceValue) {
            $tablePriceMock = $this->getMockBuilder('\Patterns\Behavioral\Visitor\Price\Prices\TablePrice')
                ->disableOriginalConstructor()
                ->getMock();

            $tablePriceMock
                ->expects($this->once())
                ->method('getPrice')
                ->will($this->returnValue($priceValue));

            $expectedArray[] = $priceValue;

            $averagePriceVisitor->visitTablePrice($tablePriceMock);

            $this->assertAttributeEquals($expectedArray, '_tablePricesValues', $averagePriceVisitor);
        }

        return $averagePriceVisitor;
    }

    /**
     * @depends testVisitTablePrice
     *
     * @param AveragePriceVisitor $averagePriceVisitor
     */
    public function testTableAveragePrice($averagePriceVisitor)
    {
        $this->assertEquals(
            $this->_priceValues['averagePrice'],
            $averagePriceVisitor->getTableAveragePrice());
    }

    public function testVisitDoorPrice()
    {
        $averagePriceVisitor = new AveragePriceVisitor();

        $expectedArray = array();

        foreach ($this->_priceValues['prices'] as $priceValue) {
            $doorPriceMock = $this->getMockBuilder('\Patterns\Behavioral\Visitor\Price\Prices\DoorPrice')
                ->disableOriginalConstructor()
                ->getMock();

            $doorPriceMock
                ->expects($this->once())
                ->method('getPrice')
                ->will($this->returnValue($priceValue));

            $expectedArray[] = $priceValue;

            $averagePriceVisitor->visitDoorPrice($doorPriceMock);

            $this->assertAttributeEquals($expectedArray, '_doorPricesValues', $averagePriceVisitor);
        }

        return $averagePriceVisitor;
    }

    /**
     * @depends testVisitDoorPrice
     *
     * @param AveragePriceVisitor $averagePriceVisitor
     */
    public function testDoorAveragePrice($averagePriceVisitor)
    {
        $this->assertEquals(
            $this->_priceValues['averagePrice'],
            $averagePriceVisitor->getDoorAveragePrice());
    }
}