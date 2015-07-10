<?php
namespace Patterns\Structural\Composite\Tree\Abstracts;

use Patterns\Structural\Composite\Tree\Exceptions\LeafHaveNotLeavesException;

abstract class AbstractLeaf extends AbstractTreeItem
{
    protected final function &_getItems()
    {
        throw new LeafHaveNotLeavesException();
    }

    protected final function &_getValue()
    {
        if ($this->_value === null) {
            $this->_value = 0;
        }

        return $this->_value;
    }

    public function getValue()
    {
        return $this->_getValue();
    }
}
