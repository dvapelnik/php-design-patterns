<?php
namespace Patterns\Behavioral\Mediator\Cash;

class Cash
{
    /** @var  CurrencyDirector */
    private $_director;

    private $_currentCash;

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
    public function getCurrentCash()
    {
        return $this->_currentCash;
    }

    /**
     * @param mixed $currentCash
     */
    public function setCurrentCash($currentCash)
    {
        $this->_currentCash = $currentCash;
    }
}