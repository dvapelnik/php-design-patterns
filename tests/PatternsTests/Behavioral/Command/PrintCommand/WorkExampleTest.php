<?php
namespace PatternsTests\Behavioral\Command\PrintCommand;

use Patterns\Behavioral\Command\Executor;
use Patterns\Behavioral\Command\PrintCommand\MacroCommand;
use Patterns\Behavioral\Command\PrintCommand\Printer;
use Patterns\Behavioral\Command\PrintCommand\SquareBracketsPrinterDecorator;
use PHPUnit_Framework_TestCase;

class WorkExampleTest extends PHPUnit_Framework_TestCase
{
    public function testWorkExample()
    {
        $words = array(
            'foo',
            'bar',
            'baz',
            'beez',
            'buzz',
        );

        $executor = new Executor();

        $expectedString = '';

        // 1st iteration
        $executor->setCommand(new Printer($words[0]));
        $executor->commandRun();
        $expectedString .= $words[0];

        // 2nd iteration
        $executor->setCommand(
            new SquareBracketsPrinterDecorator(
                new Printer($words[1])));
        $executor->commandRun();
        $expectedString .= '[' . $words[1] . ']';

        // 3rd iteration
        $executor->setCommand(
            new SquareBracketsPrinterDecorator(
                new SquareBracketsPrinterDecorator(
                    new Printer($words[2]))));
        $executor->commandRun();
        $expectedString .= '[[' . $words[2] . ']]';

        $macroCommand = new MacroCommand();
        $macroCommand->addCommand(new Printer($words[3]));
        $macroCommand->addCommand(
            new SquareBracketsPrinterDecorator(
                new Printer($words[4])));
        $executor->setCommand($macroCommand);
        $executor->commandRun();
        $expectedString .= $words[3] . '[' . $words[4] . ']';

        $this->expectOutputString($expectedString);
    }
}