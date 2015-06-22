<?php
namespace Patterns\Structural\Bridge\ListRenderer\Renderers;

use Patterns\Creational\Singleton\SingletonTrait;

abstract class AbstractRenderer
{
    use SingletonTrait;

    abstract public function render($items);
}