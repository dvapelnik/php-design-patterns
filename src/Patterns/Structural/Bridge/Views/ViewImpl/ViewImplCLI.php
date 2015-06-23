<?php
namespace Patterns\Structural\Bridge\Views\ViewImpl;

class ViewImplCLI extends AbstractViewImpl
{
    protected $_result = "";

    public function drawLine()
    {
        $this->appendResult(str_repeat('-', 80) . PHP_EOL);
    }

    public function drawText($text)
    {
        $this->appendResult($text . PHP_EOL);
    }

    protected function appendResult($result)
    {
        $this->_result .= $result;
    }

    public function getResult()
    {
        return $this->_result;
    }

}