<?php
namespace Patterns\Structural\Composite\Tree\Abstracts;

use Patterns\Structural\Composite\Tree\Exceptions\NodeHaveNotValueException;

abstract class AbstractNode extends AbstractTreeItem
{
    protected final function &_getItems()
    {
        if ($this->_items === null) {
            $this->_items = array();
        }

        return $this->_items;
    }

    protected final function &_getValue()
    {
        throw new NodeHaveNotValueException();
    }

    public function getValue()
    {
        $_items =& $this->_getItems();

        if (count($_items)) {
            return array_reduce($_items, function ($carry, AbstractTreeItem $_item) {
                return $carry + $_item->getValue();
            }, 0);
        } else {
            return 0;
        }
    }
}