<?php
namespace Patterns\Behavioral\Visitor\Price\Prices;

use Patterns\Behavioral\Visitor\Price\PriceVisitors\AbstractPriceVisitor;

class TablePrice extends AbstractPrice
{
    public function acceptVisitor(AbstractPriceVisitor $visitor)
    {
        $visitor->visitTablePrice($this);
    }
}