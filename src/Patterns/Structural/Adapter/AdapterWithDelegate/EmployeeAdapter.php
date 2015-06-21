<?php
namespace Patterns\Structural\Adapter\AdapterWithDelegate;

class EmployeeAdapter implements StructureAdapterInterface
{
    public function getHead($structure)
    {
        return $structure->getChief();
    }

    public function getSlaves($structure)
    {
        return $structure->getEmployers();
    }
}