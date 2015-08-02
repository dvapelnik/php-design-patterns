<?php
namespace Patterns\Behavioral\Visitor\Price\PriceVisitors;

use Patterns\Behavioral\Visitor\Price\Prices\AbstractPrice;
use SplObjectStorage;

abstract class AbstractPriceVisitor
{
    abstract public function visitTablePrice(AbstractPrice $price);

    abstract public function visitDoorPrice(AbstractPrice $price);
}