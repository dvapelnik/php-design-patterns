<?php
namespace Patterns\Behavioral\Observer\Cash;

use SplObjectStorage;

class Purse
{
    /** @var  SplObjectStorage */
    private $_observerObjectList;

    private $_cashAmount;

    /**
     * Purse constructor.
     */
    public function __construct()
    {
        $this->_observerObjectList = new SplObjectStorage();

        $this->_cashAmount = 0;
    }

    public function addCash($additionCashAmount)
    {
        if ($this->_cashAmount === null) {
            $this->_cashAmount = 0;
        }

        $this->_cashAmount += $additionCashAmount;
    }

    public function attach(AbstractCashObserver $observer)
    {
        $this->_observerObjectList->attach($observer);
    }

    public function detach(AbstractCashObserver $observer)
    {
        $this->_observerObjectList->detach($observer);
    }

    public function notify()
    {
        $observers = $this->_observerObjectList;

        for ($observers->rewind(); $observers->valid(); $observers->next()) {
            /** @var AbstractCashObserver $observer */
            $observer = $observers->current();

            $observer->update($this);
        }
    }

    /**
     * @return int
     */
    public function getCashAmount()
    {
        return $this->_cashAmount;
    }
}