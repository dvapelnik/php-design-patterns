<?php
namespace Patterns\Structural\Bridge\Views\ViewImpl;

class ViewImplJSON extends AbstractViewImpl
{
    protected $_result = array();

    public function drawLine()
    {
        $this->appendResult(array(
            'type' => 'line'
        ));
    }

    public function drawText($text)
    {
        $this->appendResult(array(
            'type' => 'text',
            'text' => $text
        ));
    }

    protected function appendResult($result)
    {
        $this->_result[] = $result;
    }

    public function getResult()
    {
        return json_encode($this->_result);
    }
}