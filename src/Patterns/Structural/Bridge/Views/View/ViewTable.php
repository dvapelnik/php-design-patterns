<?php
namespace Patterns\Structural\Bridge\Views\View;

class ViewTable extends AbstractView
{
    public function drawCell($text)
    {
        $this->drawLine();
        $this->drawText($text);
        $this->drawLine();
    }
}