<?php
namespace Patterns\Structural\Bridge\Views\ViewImpl;

abstract class AbstractViewImpl
{
    abstract public function drawText($text);

    abstract public function drawLine();

    abstract public function getResult();

    abstract protected function appendResult($result);
}