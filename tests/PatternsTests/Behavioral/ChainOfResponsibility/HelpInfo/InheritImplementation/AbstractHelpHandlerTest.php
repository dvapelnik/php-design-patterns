<?php
namespace PatternsTests\Behavioral\ChainOfResponsibility\HelpInfo\InheritImplementation;

use PHPUnit_Framework_TestCase;
use ReflectionClass;

class AbstractHelpHandlerTest extends PHPUnit_Framework_TestCase
{
    public function testGetHelpInfo()
    {
        $abstractHelpHandlerClassName =
            '\Patterns\Behavioral\ChainOfResponsibility\HelpInfo\InheritImplementation\AbstractHelpHandler';

        $willReturnValue = 'Empty help data';

        $methodName = 'getHelpInfo';

        $stubForAbstractHelpHandler = $this
            ->getMockForAbstractClass($abstractHelpHandlerClassName);

        $this->assertEquals($willReturnValue, $stubForAbstractHelpHandler->{$methodName}());
    }
}