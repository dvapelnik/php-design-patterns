<?php
namespace PatternsTests\Structural\Bridge\Views\ViewImpl;

use Patterns\Structural\Bridge\Views\ViewImpl\AbstractViewImpl;
use Patterns\Structural\Bridge\Views\ViewImpl\ViewImplCLI;
use PHPUnit_Framework_TestCase;
use ReflectionClass;
use ReflectionProperty;

class ViewImplCLITest extends PHPUnit_Framework_TestCase
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

    public function setUp()
    {
        $this->_viewImpl = new ViewImplCLI();

        $this->_viewImplReflected = new ReflectionClass('Patterns\Structural\Bridge\Views\ViewImpl\ViewImplCLI');
        $this->_viewImplReflectedPropertyResult = $this->_viewImplReflected->getProperty('_result');
        $this->_viewImplReflectedPropertyResult->setAccessible(true);
    }

    public function testAppendResultIsEmptyAfterConstruct()
    {
        $this->assertEmpty($this->_viewImplReflectedPropertyResult->getValue($this->_viewImpl));
    }

    public function testAppendResult()
    {
        $this->_viewImpl->drawLine();

        $this->assertEquals(
            $this->_getLine() . PHP_EOL,
            $this->_viewImplReflectedPropertyResult->getValue($this->_viewImpl));
    }

    public function testAppendText()
    {
        $this->_viewImpl->drawText($this->_text);

        $this->assertEquals(
            $this->_text . PHP_EOL,
            $this->_viewImplReflectedPropertyResult->getValue($this->_viewImpl));
    }

    public function testAppendTextAndLines()
    {
        $this->_viewImpl->drawLine();
        $this->_viewImpl->drawText($this->_text);
        $this->_viewImpl->drawLine();

        $this->assertEquals(
            implode(PHP_EOL, array($this->_getLine(), $this->_text, $this->_getLine())) . PHP_EOL,
            $this->_viewImplReflectedPropertyResult->getValue($this->_viewImpl));
    }

    public function testGetResult()
    {
        $this->_viewImpl->drawLine();
        $this->_viewImpl->drawText($this->_text);
        $this->_viewImpl->drawLine();

        $this->assertEquals(
            implode(PHP_EOL, array($this->_getLine(), $this->_text, $this->_getLine())) . PHP_EOL,
            $this->_viewImpl->getResult());
    }
}