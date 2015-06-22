<?php
namespace Patterns\Structural\Bridge\ListRenderer\Renderers;

class ImplodeRenderer extends AbstractRenderer
{
    protected static $_delimiter = '';

    public function render($items)
    {
        return implode(static::$_delimiter, $items);
    }
}