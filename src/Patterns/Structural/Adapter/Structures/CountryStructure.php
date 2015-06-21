<?php
namespace Patterns\Structural\Adapter\Structures;

class CountryStructure
{
    private $_country;
    private $_cities;

    public function __construct($country, $cities = array())
    {
        $this->_country = $country;
        $this->_cities = $cities;
    }

    public function getCountry()
    {
        return $this->_country;
    }

    public function getCities()
    {
        return $this->_cities;
    }
}