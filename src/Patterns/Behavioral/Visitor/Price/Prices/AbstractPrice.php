<?php
namespace Patterns\Behavioral\Visitor\Price\Prices;

use Patterns\Behavioral\Visitor\Price\PriceVisitors\AbstractPriceVisitor;

abstract class AbstractPrice
{
    private $_price;

    /**
     * AbstractPrice constructor.
     *
     * @param $_price
     */
    public function __construct($_price)
    {
        $this->_price = $_price;
    }

    abstract public function acceptVisitor(AbstractPriceVisitor $visitor);

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->_price;
    }
}