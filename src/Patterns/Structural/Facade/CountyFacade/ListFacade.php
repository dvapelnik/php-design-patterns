<?php
namespace Patterns\Structural\Facade\CountyFacade;

use Patterns\Creational\Singleton\Classic\Singleton;
use Patterns\Structural\Bridge\ListRenderer\Lists\AbstractList;
use Patterns\Structural\Facade\CountyFacade\Counters\CounterInterface;
use Patterns\Structural\Facade\CountyFacade\LIstFacadeExceptions\FacadeIsNotConfiguredException;

class ListFacade extends Singleton
{
    /** @var  AbstractList */
    private $_listContainer;

    /** @var  CounterInterface */
    private $_counter;

    private function _isConfigured()
    {
        return
            $this->_counter !== null &&
            $this->_listContainer !== null;
    }

    public function configure(AbstractList $list = null, CounterInterface $counter = null)
    {
        if ($list !== null) {
            $this->_listContainer = $list;
        }

        if ($counter !== null) {
            $this->_counter = $counter;
        }
    }

    public function getItems()
    {
        if (!$this->_isConfigured()) {
            throw new FacadeIsNotConfiguredException;
        }

        return $this->_listContainer->getItems();
    }

    public function getSummaryValue()
    {
        if (!$this->_isConfigured()) {
            throw new FacadeIsNotConfiguredException;
        }

        return $this->_counter->getSummaryValue($this->_listContainer);
    }
}