<?php
namespace PatternsTests\Behavioral\Command\PrintCommand;

use Patterns\Behavioral\Command\Executor;
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

        $this->expectOutputString($expectedString);
    }
}