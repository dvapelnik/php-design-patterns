<?php
namespace Patterns\Structural\Adapter\AdapterWithAbstractMethods;

use Patterns\Structural\Adapter\Structures\CountryStructure;

class CountryPrinter extends AbstractPrinter
{
    /** @var  CountryStructure */
    private $_countryStructure;

    public function __construct($countryStructure)
    {
        $this->_countryStructure = $countryStructure;
    }

    protected function _getHead()
    {
        return $this->_countryStructure->getCountry();
    }

    protected function _getSlaves()
    {
        return $this->_countryStructure->getCities();
    }
}