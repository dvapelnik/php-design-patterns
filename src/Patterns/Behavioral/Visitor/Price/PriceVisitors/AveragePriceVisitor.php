<?php
namespace Patterns\Behavioral\Visitor\Price\PriceVisitors;

use Patterns\Behavioral\Visitor\Price\Prices\AbstractPrice;

class AveragePriceVisitor extends AbstractPriceVisitor
{
    private $_tablePricesValues = array();

    private $_doorPricesValues = array();

    public function visitTablePrice(AbstractPrice $price)
    {
        $this->_tablePricesValues[] = $price->getPrice();
    }

    public function visitDoorPrice(AbstractPrice $price)
    {
        $this->_doorPricesValues[] = $price->getPrice();
    }

    public function getTableAveragePrice()
    {
        return array_sum($this->_tablePricesValues) / count($this->_tablePricesValues);
    }

    public function getDoorAveragePrice()
    {
        return array_sum($this->_doorPricesValues) / count($this->_doorPricesValues);
    }
}