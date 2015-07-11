<?php
namespace Patterns\Structural\Facade\CountyFacade\Counters;

use Patterns\Structural\Bridge\ListRenderer\Lists\AbstractList;

class ClosureCounter implements CounterInterface
{
    public function getSummaryValue(AbstractList $list)
    {
        return array_reduce($list->getItems(), function ($carry, $item) {
            return $carry + $item;
        }, 0);
    }
}