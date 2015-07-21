<?php
namespace PatternsTests\Behavioral\Command;

use Patterns\Behavioral\Command\Executor;
use Patterns\Behavioral\Command\PrintCommand\Printer;
use PHPUnit_Framework_TestCase;
use ReflectionProperty;

class ExecutorTest extends PHPUnit_Framework_TestCase
{
    /** @var  ReflectionProperty */
    private $_reflectedCommandProp;

    private $_text;

    public function setUp()
    {
        $this->_reflectedCommandProp = new ReflectionProperty(
            '\Patterns\Behavioral\Command\Executor',
            '_command');
        $this->_reflectedCommandProp->setAccessible(true);

        $this->_text = 'foo bar';
    }

    public function testSetCommand()
    {
        $executor = new Executor();

        $this->assertNull($this->_reflectedCommandProp->getValue($executor));

        $command = new Printer($this->_text);

        $executor->setCommand($command);

        $this->assertSame($command, $this->_reflectedCommandProp->getValue($executor));

        return $executor;
    }

    /**
     * @depends testSetCommand
     */
    public function testCommandRun(Executor $executor)
    {
        $this->expectOutputString($this->_text);

        $executor->commandRun();
    }
}