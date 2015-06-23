<?php
namespace PatternsTests\Structural\Bridge\Views\ViewImpl;

use Patterns\Structural\Bridge\Views\ViewImpl\AbstractViewImpl;
use Patterns\Structural\Bridge\Views\ViewImpl\ViewImplJSON;
use PHPUnit_Framework_TestCase;
use ReflectionClass;
use ReflectionProperty;

class ViewImplJSONText extends PHPUnit_Framework_TestCase
{
    /** @var  AbstractViewImpl */
    private $_viewImpl;
    private $_viewImplReflected;
    /** @var ReflectionProperty */
    private $_viewImplReflectedPropertyResult;

    private $_text = 'some text';

    private function _getLine()
    {
        return str_repeat('-', 80);
    }

    private $_expectedResult;

    private function _appendLine()
    {
        $this->_appendToResult(array('type' => 'line'));
    }

    private function _appendToResult($appendix)
    {
        $this->_expectedResult[] = $appendix;
    }

    private function _appendText($text)
    {
        $this->_appendToResult(array(
            'type' => 'text',
            'text' => $text,
        ));
    }

    public function setUp()
    {
        $this->_expectedResult = array();

        $this->_viewImpl = new ViewImplJSON();

        $this->_viewImplReflected = new ReflectionClass('Patterns\Structural\Bridge\Views\ViewImpl\ViewImplJSON');
        $this->_viewImplReflectedPropertyResult = $this->_viewImplReflected->getProperty('_result');
        $this->_viewImplReflectedPropertyResult->setAccessible(true);
    }

    public function testResultIsEmptyAfterConstruct()
    {
        $this->assertEmpty($this->_viewImplReflectedPropertyResult->getValue($this->_viewImpl));
    }

    public function testDrawLine()
    {
        $this->_viewImpl->drawLine();

        $this->_appendLine();

        $this->assertEquals(
            $this->_expectedResult,
            $this->_viewImplReflectedPropertyResult->getValue($this->_viewImpl));
    }

    public function testDrawText()
    {
        $this->_viewImpl->drawText($this->_text);

        $this->_appendText($this->_text);

        $this->assertEquals(
            $this->_expectedResult,
            $this->_viewImplReflectedPropertyResult->getValue($this->_viewImpl));
    }

    public function testAppendTextAndLines()
    {
        $this->_viewImpl->drawLine();
        $this->_viewImpl->drawText($this->_text);
        $this->_viewImpl->drawLine();

        $this->_appendLine();
        $this->_appendText($this->_text);
        $this->_appendLine();

        $this->assertEquals(
            $this->_expectedResult,
            $this->_viewImplReflectedPropertyResult->getValue($this->_viewImpl));
    }

    public function testGetResult()
    {
        $this->_viewImpl->drawLine();
        $this->_viewImpl->drawText($this->_text);
        $this->_viewImpl->drawLine();

        $this->_appendLine();
        $this->_appendText($this->_text);
        $this->_appendLine();

        $this->assertEquals(
            json_encode($this->_expectedResult),
            $this->_viewImpl->getResult());
    }
}