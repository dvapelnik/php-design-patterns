<?php
namespace Patterns\Structural\Bridge\ListRenderer\Lists;

use Patterns\Structural\Bridge\ListRenderer\Renderers\AbstractRenderer;
use Patterns\Structural\Bridge\ListRenderer\Renderers\RendererFactory;

abstract class AbstractList implements ListInterface
{
    /** @var  AbstractRenderer */
    protected $_renderer;

    public function __construct($items)
    {
        $this->_setItems($items);
        $this->_renderer = RendererFactory::GetInstance()->getRenderer(count($items));
    }

    abstract protected function _setItems($items);

    public function getRenderedItems()
    {
        return $this->_renderer->render($this->getItems());
    }
}