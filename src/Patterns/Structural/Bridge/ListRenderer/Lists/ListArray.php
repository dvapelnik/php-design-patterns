<?php
namespace Patterns\Structural\Bridge\ListRenderer\Lists;

class ListArray extends AbstractList
{
    private $_items;

    public function getItems()
    {
        return $this->_items;
    }

    protected function _setItems($items)
    {
        $this->_items = $items;
    }
}