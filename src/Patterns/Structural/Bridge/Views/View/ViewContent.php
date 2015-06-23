<?php
namespace Patterns\Structural\Bridge\Views\View;

class ViewContent extends AbstractView
{
    public function printParagraph($text)
    {
        $this->drawText($text);
    }
}