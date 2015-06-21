<?php
namespace Patterns\Structural\Adapter\AdapterWithDelegate;

use Patterns\Structural\Adapter\StructurePrinterInterface;

class StructurePrinter implements StructurePrinterInterface
{
    /** @var StructureAdapterInterface */
    private $_structureAdapter;

    private $_structure;

    public function __construct($structure)
    {
        $this->_structure = $structure;
    }

    public function setAdapter(StructureAdapterInterface $structureAdapter)
    {
        $this->_structureAdapter = $structureAdapter;
    }

    public function getString()
    {
        if ($this->_structureAdapter === null) {
            throw new StructurePrinterException('Delegate adapter not specified');
        }

        $result = $this->_structureAdapter->getHead($this->_structure);

        $result .= ' ' . sprintf('(%s)', implode(', ', $this->_structureAdapter->getSlaves($this->_structure)));

        return $result;
    }
}