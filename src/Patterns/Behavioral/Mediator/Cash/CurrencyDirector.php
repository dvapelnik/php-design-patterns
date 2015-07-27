<?php
namespace Patterns\Behavioral\Mediator\Cash;

class CurrencyDirector
{
    /** @var  Cash */
    private $_cash;

    /** @var  CurrencySelector */
    private $_currencySelector;

    private $_currencyRates;

    private $_cashAmountInDefaultCurrency;

    private $_defaultCurrency;

    /**
     * CurrencyDirector constructor.
     */
    public function __construct($currencyRates, $cashAmountInDefaultCurrency, $defaultCurrency)
    {
        $this->_currencyRates = $currencyRates;
        $this->_cashAmountInDefaultCurrency = $cashAmountInDefaultCurrency;
        $this->_defaultCurrency = $defaultCurrency;

        $this->_createElements();
    }

    private function _createElements()
    {
        $this->_cash = new Cash($this);
        $this->_currencySelector = new CurrencySelector($this);

        $this->_currencySelector->setCurrentCurrency($this->_defaultCurrency);
    }

    /**
     * @return Cash
     */
    public function getCash()
    {
        return $this->_cash;
    }

    /**
     * @return CurrencySelector
     */
    public function getCurrencySelector()
    {
        return $this->_currencySelector;
    }

    /**
     * @param Cash|CurrencySelector $element
     */
    public function elementChanged($element)
    {
        switch (get_class($element)) {
            case 'Patterns\Behavioral\Mediator\Cash\CurrencySelector':
                $this->_cash->setCurrentCash(
                    $this->_cashAmountInDefaultCurrency * $this->_currencyRates[$element->getCurrentCurrency()]);
                break;
        }
    }
}