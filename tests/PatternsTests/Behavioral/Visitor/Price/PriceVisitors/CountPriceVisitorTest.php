<?php
namespace PatternsTests\Behavioral\Visitor\Price\PriceVisitors;

use Patterns\Behavioral\Visitor\Price\Prices\DoorPrice;
use Patterns\Behavioral\Visitor\Price\Prices\TablePrice;
use Patterns\Behavioral\Visitor\Price\PriceVisitors\CountPriceVisitor;
use PHPUnit_Framework_TestCase;

class CountPriceVisitorTest extends PHPUnit_Framework_TestCase
{
    private $_priceCounts = array(
        'table' => 10,
        'door'  => 11,
    );

    public function testVisitTablePrice()
    {
        $countPriceVisitor = new CountPriceVisitor();

        for ($i = 0; $i < $this->_priceCounts['table']; $i++) {
            $countPriceVisitor->visitTablePrice(new TablePrice(0));

            $this->assertAttributeEquals($i + 1, '_countOfTablePrices', $countPriceVisitor);
        }

        return $countPriceVisitor;
    }

    /**
     * @depends testVisitTablePrice
     *
     * @param CountPriceVisitor $countPriceVisitor
     */
    public function testGetCountOfTablePlaces($countPriceVisitor)
    {
        $this->assertEquals($this->_priceCounts['table'], $countPriceVisitor->getCountOfTablePrices());
    }

    public function testVisitDoorPrice()
    {
        $countPriceVisitor = new CountPriceVisitor();

        for ($i = 0; $i < $this->_priceCounts['door']; $i++) {
            $countPriceVisitor->visitDoorPrice(new DoorPrice(0));

            $this->assertAttributeEquals($i + 1, '_countOfDoorPrices', $countPriceVisitor);
        }

        return $countPriceVisitor;
    }

    /**
     * @depends testVisitDoorPrice
     *
     * @param CountPriceVisitor $countPriceVisitor
     */
    public function testGetCountOfDoorPlaces($countPriceVisitor)
    {
        $this->assertEquals($this->_priceCounts['door'], $countPriceVisitor->getCountOfDoorPrices());
    }
}