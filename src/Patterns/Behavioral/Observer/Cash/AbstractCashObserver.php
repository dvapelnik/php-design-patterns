<?php
namespace Patterns\Behavioral\Observer\Cash;

abstract class AbstractCashObserver
{
    abstract function update(Purse $purse);
}