<?php
namespace Patterns\Structural\Bridge\ListRenderer\Renderers;

use Patterns\Creational\Singleton\SingletonTrait;

class RendererFactory
{
    use SingletonTrait;

    public function getRenderer($itemListLength)
    {
        if ($itemListLength > 0 && $itemListLength <= 5) {
            return FatImplodeRenderer::getInstance();
        }

        if ($itemListLength > 5 && $itemListLength <= 10) {
            return SkinnyImplodeRenderer::getInstance();
        }

        return ImplodeRenderer::getInstance();
    }
}