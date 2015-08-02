<?php
namespace PatternsTests\Behavioral\Visitor\Price;

use Patterns\Behavioral\Visitor\Price\Prices\AbstractPrice;
use Patterns\Behavioral\Visitor\Price\Prices\DoorPrice;
use Patterns\Behavioral\Visitor\Price\Prices\TablePrice;
use Patterns\Behavioral\Visitor\Price\PriceVisitors\AveragePriceVisitor;
use Patterns\Behavioral\Visitor\Price\PriceVisitors\CountPriceVisitor;
use PHPUnit_Framework_TestCase;

class WorkExampleTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function work()
    {
        $dataArray = array(
            'tables' => array(2, 3, 4, 1, 5),
            'doors'  => array(3, 5, 2, 6, 4, 4),
        );

        /** @var AbstractPrice[] $pricesArray */
        $pricesArray = array();

        // Fill array with table prices
        foreach ($dataArray['tables'] as $price) {
            $pricesArray[] = new TablePrice($price);
        }

        // Fill array with door prices
        foreach ($dataArray['doors'] as $price) {
            $pricesArray[] = new DoorPrice($price);
        }

        // Shuffle place array
        shuffle($pricesArray);

        $averagePriceVisitor = new AveragePriceVisitor();
        $countPriceVisitor = new CountPriceVisitor();

        foreach ($pricesArray as $price) {
            $price->acceptVisitor($averagePriceVisitor);
            $price->acceptVisitor($countPriceVisitor);
        }

        // Average price for tables
        $this->assertEquals(
            array_sum($dataArray['tables']) / count($dataArray['tables']),
            $averagePriceVisitor->getTableAveragePrice());

        // Average price for doors
        $this->assertEquals(
            array_sum($dataArray['doors']) / count($dataArray['doors']),
            $averagePriceVisitor->getDoorAveragePrice());

        // Count of table prices
        $this->assertEquals(
            count($dataArray['tables']),
            $countPriceVisitor->getCountOfTablePrices());

        // Count of door prices
        $this->assertEquals(
            count($dataArray['doors']),
            $countPriceVisitor->getCountOfDoorPrices());
    }
}