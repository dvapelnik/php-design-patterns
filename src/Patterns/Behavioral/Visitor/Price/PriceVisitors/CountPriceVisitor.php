<?php
namespace Patterns\Behavioral\Visitor\Price\PriceVisitors;

use Patterns\Behavioral\Visitor\Price\Prices\AbstractPrice;

class CountPriceVisitor extends AbstractPriceVisitor
{
    private $_countOfTablePrices = 0;

    private $_countOfDoorPrices = 0;

    public function visitTablePrice(AbstractPrice $price)
    {
        $this->_countOfTablePrices++;
    }

    public function visitDoorPrice(AbstractPrice $price)
    {
        $this->_countOfDoorPrices++;
    }

    /**
     * @return int
     */
    public function getCountOfTablePrices()
    {
        return $this->_countOfTablePrices;
    }

    /**
     * @return int
     */
    public function getCountOfDoorPrices()
    {
        return $this->_countOfDoorPrices;
    }
}