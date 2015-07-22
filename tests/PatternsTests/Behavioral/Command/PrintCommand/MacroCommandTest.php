<?php
namespace PatternsTests\Behavioral\Command\PrintCommand;

use Patterns\Behavioral\Command\CommandInterface;
use Patterns\Behavioral\Command\PrintCommand\MacroCommand;
use Patterns\Behavioral\Command\PrintCommand\Printer;
use Patterns\Behavioral\Command\PrintCommand\SquareBracketsPrinterDecorator;
use PHPUnit_Framework_TestCase;
use ReflectionProperty;

class MacroCommandTest extends PHPUnit_Framework_TestCase
{
    /** @var  ReflectionProperty */
    private $_reflectedCommandsProp;

    private $_commands;

    private $_words;

    public function setUp()
    {
        $this->_reflectedCommandsProp = new ReflectionProperty(
            '\Patterns\Behavioral\Command\PrintCommand\MacroCommand',
            '_commands');
        $this->_reflectedCommandsProp->setAccessible(true);

        $this->_commands = array(
            new MacroCommand(),
            new MacroCommand(),
        );

        $this->_words = array(
            'foo',
            'bar',
        );
    }

    public function testConstructor()
    {
        $macroCommand = new MacroCommand();
        $this->assertEquals(array(), $this->_reflectedCommandsProp->getValue($macroCommand));

        return $macroCommand;
    }

    /**
     * @depends      testConstructor
     */
    public function testAddCommand(MacroCommand $macroCommand)
    {
        $macroCommand->addCommand($this->_commands[0]);
        $this->assertEquals(
            array($this->_commands[0]),
            $this->_reflectedCommandsProp->getValue($macroCommand));

        $macroCommand->addCommand($this->_commands[1]);
        $this->assertEquals(
            array($this->_commands[0], $this->_commands[1]),
            $this->_reflectedCommandsProp->getValue($macroCommand));

        return $macroCommand;
    }

    /**
     * @depends testAddCommand
     */
    public function testGetCommands(MacroCommand $macroCommand)
    {
        $this->assertEquals(
            $this->_commands,
            $macroCommand->getCommands());
    }

    /**
     * @depends testAddCommand
     */
    public function testEraseCommand(MacroCommand $macroCommand)
    {
        $this->assertNotNull($this->_reflectedCommandsProp->getValue($macroCommand));
        $this->assertNotEquals(array(), $this->_reflectedCommandsProp->getValue($macroCommand));

        $macroCommand->eraseCommands();

        $this->assertEquals(array(), $this->_reflectedCommandsProp->getValue($macroCommand));
    }

    public function testRemoveCommand()
    {
        $macroCommand = new MacroCommand();

        $removedCommand = $macroCommand->removeCommand(0);
        $this->assertFalse($removedCommand);

        $macroCommand->addCommand($this->_commands[0]);
        $removedCommand = $macroCommand->removeCommand(0);

        $this->assertSame($this->_commands[0], $removedCommand);
        $this->assertEquals(array(), $this->_reflectedCommandsProp->getValue($macroCommand));
    }

    /**
     * @depends testConstructor
     */
    public function testExecute(MacroCommand $macroCommand)
    {
        $macroCommand->addCommand(new Printer($this->_words[0]));
        $macroCommand->addCommand(new SquareBracketsPrinterDecorator(new Printer($this->_words[1])));
        $macroCommand->execute();

        $this->expectOutputString(
            $this->_words[0] .
            '[' . $this->_words[1] . ']');
    }
}