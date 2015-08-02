<?php
namespace Patterns\Behavioral\Visitor\Price\Prices;

use Patterns\Behavioral\Visitor\Price\PriceVisitors\AbstractPriceVisitor;

class DoorPrice extends AbstractPrice
{
    public function acceptVisitor(AbstractPriceVisitor $visitor)
    {
        $visitor->visitDoorPrice($this);
    }
}