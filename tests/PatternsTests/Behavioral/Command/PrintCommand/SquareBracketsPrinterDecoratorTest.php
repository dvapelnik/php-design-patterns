<?php
namespace PatternsTests\Behavioral\Command\PrintCommand;

use Patterns\Behavioral\Command\CommandInterface;
use Patterns\Behavioral\Command\PrintCommand\Printer;
use Patterns\Behavioral\Command\PrintCommand\SquareBracketsPrinterDecorator;
use PHPUnit_Framework_TestCase;
use ReflectionProperty;

class SquareBracketsPrinterDecoratorTest extends PHPUnit_Framework_TestCase
{
    private $_text;

    /** @var  ReflectionProperty */
    private $_reflectedCommandProp;

    public function setUp()
    {
        $this->_reflectedCommandProp = new \ReflectionProperty(
            '\Patterns\Behavioral\Command\PrintCommand\SquareBracketsPrinterDecorator',
            '_command');
        $this->_reflectedCommandProp->setAccessible(true);

        $this->_text = 'foo bar baz beez';
    }

    public function testConstructor()
    {
        $command = new Printer($this->_text);

        $commandDecorator = new SquareBracketsPrinterDecorator($command);

        $this->assertSame($command, $this->_reflectedCommandProp->getValue($commandDecorator));

        return $commandDecorator;
    }

    /**
     * @depends testConstructor
     */
    public function testExecute(CommandInterface $commandDecorator)
    {
        $this->expectOutputString('[' . $this->_text . ']');

        $commandDecorator->execute();
    }
}