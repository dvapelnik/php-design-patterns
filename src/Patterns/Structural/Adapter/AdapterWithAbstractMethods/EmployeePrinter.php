<?php
namespace Patterns\Structural\Adapter\AdapterWithAbstractMethods;

use Patterns\Structural\Adapter\Structures\EmployeeStructure;

class EmployeePrinter extends AbstractPrinter
{
    /** @var  EmployeeStructure */
    private $_employeeStructure;

    public function __construct($employeeStructure)
    {
        $this->_employeeStructure = $employeeStructure;
    }

    protected function _getHead()
    {
        return $this->_employeeStructure->getChief();
    }

    protected function _getSlaves()
    {
        return $this->_employeeStructure->getEmployers();
    }
}