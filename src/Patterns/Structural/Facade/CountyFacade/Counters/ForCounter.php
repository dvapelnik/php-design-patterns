<?php
namespace Patterns\Structural\Facade\CountyFacade\Counters;

use Patterns\Structural\Bridge\ListRenderer\Lists\AbstractList;

class ForCounter implements CounterInterface
{
    public function getSummaryValue(AbstractList $list)
    {
        $_items = $list->getItems();

        $_result = 0;

        for ($i = 0; $i < count($_items); $i++) {
            $_result += $_items[$i];
        }

        return $_result;
    }
}