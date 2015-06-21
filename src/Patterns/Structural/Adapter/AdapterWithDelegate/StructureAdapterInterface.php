<?php
namespace Patterns\Structural\Adapter\AdapterWithDelegate;

use Patterns\Structural\Adapter\Structures\CountryStructure;
use Patterns\Structural\Adapter\Structures\EmployeeStructure;

interface StructureAdapterInterface
{
    /**
     * @param $structure CountryStructure|EmployeeStructure
     *
     * @return mixed
     */
    public function getHead($structure);

    /**
     * @param $structure CountryStructure|EmployeeStructure
     *
     * @return mixed
     */
    public function getSlaves($structure);
}