<?php
namespace Patterns\Structural\Facade\CountyFacade\Counters;

use Patterns\Structural\Bridge\ListRenderer\Lists\AbstractList;

interface CounterInterface
{
    public function getSummaryValue(AbstractList $list);
}