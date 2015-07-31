<?php
namespace Patterns\Behavioral\Observer\Cash;

class SimplePurseDisplay extends AbstractCashObserver
{
    private $_purse;

    private $_cashAmountOnPurse;

    public function __construct(Purse $subject)
    {
        $this->_purse = $subject;

        $subject->attach($this);

        $this->update($subject);
    }

    public function update(Purse $purse)
    {
        if ($this->_purse === $purse) {
            $this->_cashAmountOnPurse = $purse->getCashAmount();
        }
    }

    /**
     * @return mixed
     */
    public function getCashAmountOnPurse()
    {
        return $this->_cashAmountOnPurse;
    }
}