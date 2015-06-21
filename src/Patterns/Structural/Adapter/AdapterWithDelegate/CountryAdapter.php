<?php
namespace Patterns\Structural\Adapter\AdapterWithDelegate;

class CountryAdapter implements StructureAdapterInterface
{
    public function getHead($structure)
    {
        return $structure->getCountry();
    }

    public function getSlaves($structure)
    {
        return $structure->getCities();
    }
}