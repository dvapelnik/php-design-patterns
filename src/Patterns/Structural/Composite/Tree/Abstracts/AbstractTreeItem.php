<?php
namespace Patterns\Structural\Composite\Tree\Abstracts;

use Patterns\Structural\Composite\Tree\Exceptions\AddItemException;
use Patterns\Structural\Composite\Tree\Exceptions\ChangeValueException;
use Patterns\Structural\Composite\Tree\Exceptions\DecrementValueException;
use Patterns\Structural\Composite\Tree\Exceptions\IncrementValueException;
use Patterns\Structural\Composite\Tree\Exceptions\ItemNotFoundException;
use Patterns\Structural\Composite\Tree\Exceptions\LeafHaveNotLeavesException;
use Patterns\Structural\Composite\Tree\Exceptions\RemoveItemException;

abstract class AbstractTreeItem
{
    protected $_items;

    protected $_value;

    /**
     * @return AbstractTreeItem[]
     */
    abstract protected function &_getItems();

    abstract protected function &_getValue();

    abstract public function getValue();

    public function add(AbstractTreeItem $item)
    {
        try {
            $_items =& $this->_getItems();
            $_items[] = $item;
        } catch(LeafHaveNotLeavesException $e) {
            throw new AddItemException('Can\'t add item into leaf');
        }
    }

    public function remove(AbstractTreeItem $item)
    {
        try {
            $_items =& $this->_getItems();

            $_index = array_search($item, $_items, true);
            if ($_index === false) {
                throw new ItemNotFoundException('Item not found');
            } else {
                unset($_items[$_index]);
            }
        } catch(LeafHaveNotLeavesException $e) {
            throw new RemoveItemException('Can\'t remove item from leaf');
        }
    }

    protected final function _changeValue($delta)
    {
        try {
            $_items =& $this->_getItems();

            foreach ($_items as $_item) {
                $_item->_changeValue($delta);
            }
        } catch(LeafHaveNotLeavesException $e) {
            $_value =& $this->_getValue();

            $_value += $delta;
        }
    }

    public function increment($delta = 1)
    {
        try {
            self::_validateDelta($delta);

            $this->_changeValue($delta);
        } catch(ChangeValueException $e) {
            throw new IncrementValueException($e->getMessage());
        }
    }

    public function decrement($delta = 1)
    {
        try {
            self::_validateDelta($delta);

            $this->_changeValue(-1 * $delta);
        } catch(ChangeValueException $e) {
            throw new DecrementValueException($e->getMessage());
        }
    }

    private final static function _validateDelta($delta)
    {
        if ($delta < 0) {
            throw new ChangeValueException('Delta cannot be negative.');
        }

        if ($delta === 0) {
            throw new ChangeValueException('Delta cannot be zero.');
        }
    }
}