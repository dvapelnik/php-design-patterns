<?php
namespace Patterns\Structural\Bridge\ListRenderer\Lists;

class ListString extends AbstractList
{
    const ITEM_DELIMITER = '-';
    const ITEM_WRAPPER_TEMPLATE = '(%s)';
    const ITEM_WRAPPER_REGEXP = '/(^(\(){1,1}|(\)){1,1}$)/';

    private $_stringItems;

    protected function _setItems($items)
    {
        $this->_stringItems = implode(self::ITEM_DELIMITER, array_map(function ($item) {
            return sprintf(self::ITEM_WRAPPER_TEMPLATE, $item);
        }, $items));
    }

    public function getItems()
    {
        return array_map(function ($itemWrapped) {
            return preg_replace(self::ITEM_WRAPPER_REGEXP, '', $itemWrapped);
        }, explode(self::ITEM_DELIMITER, $this->_stringItems));
    }
}