<?php
namespace Patterns\Structural\Adapter\Structures;

class EmployeeStructure
{
    private $_chief;
    private $_employers;

    public function __construct($chief, $employers = array())
    {
        $this->_chief = $chief;
        $this->_employers = $employers;
    }

    public function getChief()
    {
        return $this->_chief;
    }

    public function getEmployers()
    {
        return $this->_employers;
    }
}