<?php
namespace Patterns\Structural\Bridge\ListRenderer\Lists;

interface ListInterface
{
    public function __construct($items);

    public function getItems();

    public function getRenderedItems();
}