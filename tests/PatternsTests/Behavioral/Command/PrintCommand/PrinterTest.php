<?php
namespace PatternsTests\Behavioral\Command\PrintCommand;

use Patterns\Behavioral\Command\Executor;
use Patterns\Behavioral\Command\PrintCommand\Printer;
use PHPUnit_Framework_TestCase;
use ReflectionProperty;

class PrinterTest extends PHPUnit_Framework_TestCase
{
    private $_text;

    /** @var  ReflectionProperty */
    private $_reflectedTextProp;

    /** @var  Printer */
    private $_printer;

    public function setUp()
    {
        $this->_reflectedTextProp = new ReflectionProperty(
            '\Patterns\Behavioral\Command\PrintCommand\Printer',
            '_text');
        $this->_reflectedTextProp->setAccessible(true);

        $this->_text = 'foo bar';

        $this->_printer = new Printer($this->_text);
    }

    public function testConstructor()
    {
        $this->assertEquals($this->_text, $this->_reflectedTextProp->getValue($this->_printer));
    }

    public function testExecute()
    {
        $this->expectOutputString($this->_text);

        $this->_printer->execute();
    }

    public function testExecuteWithEmptyText()
    {
        $this->_reflectedTextProp->setValue($this->_printer, null);

        $this->expectOutputString('');

        $this->_printer->execute();
    }


}