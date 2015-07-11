<?php
namespace Patterns\Structural\Decorator\String;

class ToCamelCaseDecorator extends AbstractDecorator
{
    public function getText()
    {
        $originalText = $this->_getTextObject->getText();

        preg_match_all('/\w+/', $originalText, $matches);

        if (isset($matches[0]) && is_array($matches[0]) && count($matches[0]) > 1) {
            return $matches[0][0] . implode('', array_map(function ($matched) {
                return ucfirst($matched);
            }, array_slice($matches[0], 1)));
        } else {
            return $originalText;
        }
    }
}