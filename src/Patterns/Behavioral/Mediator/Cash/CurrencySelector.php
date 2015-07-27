<?php
namespace Patterns\Behavioral\Mediator\Cash;

class CurrencySelector
{
    /** @var  CurrencyDirector */
    private $_director;

    private $_currentCurrency;

    /**
     * CurrencySelector constructor.
     */
    public function __construct(CurrencyDirector $director)
    {
        $this->_director = $director;
    }

    /**
     * @return mixed
     */
    public function getCurrentCurrency()
    {
        return $this->_currentCurrency;
    }

    /**
     * @param mixed $currentCurrency
     */
    public function setCurrentCurrency($currentCurrency)
    {
        $this->_currentCurrency = $currentCurrency;
        $this->_director->elementChanged($this);
    }
}