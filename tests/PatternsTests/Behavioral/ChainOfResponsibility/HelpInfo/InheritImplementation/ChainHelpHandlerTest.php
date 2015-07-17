<?php
namespace PatternsTests\Behavioral\ChainOfResponsibility\HelpInfo\InheritImplementation;

use Patterns\Behavioral\ChainOfResponsibility\HelpInfo\InheritImplementation\ButtonOKHelpHandler;
use Patterns\Behavioral\ChainOfResponsibility\HelpInfo\InheritImplementation\EmptyHelpHandler;
use PHPUnit_Framework_TestCase;

class ChainHelpHandlerTest extends PHPUnit_Framework_TestCase
{
    public function testEmptyHelpHandler()
    {
        $emptyHelpHandler = new EmptyHelpHandler();

        $this->assertEquals('Empty help data', $emptyHelpHandler->getHelpInfo());
    }

    public function testButtonOkHelpHandler()
    {
        $buttonOkHelpHandler = new ButtonOKHelpHandler();

        $this->assertEquals('Button OK help data', $buttonOkHelpHandler->getHelpInfo());
    }
}