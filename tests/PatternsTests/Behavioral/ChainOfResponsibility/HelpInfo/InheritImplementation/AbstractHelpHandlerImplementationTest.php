<?php
namespace PatternsTests\Behavioral\ChainOfResponsibility\HelpInfo\InheritImplementation;

use PHPUnit_Framework_TestCase;
use ReflectionClass;
use ReflectionProperty;

class AbstractHelpHandlerImplementationTest extends PHPUnit_Framework_TestCase
{
    public function testGetHelpInfo()
    {
        $abstractHelpHandlerClassName =
            '\Patterns\Behavioral\ChainOfResponsibility\HelpInfo' .
            '\InheritImplementation\AbstractHelpHandlerImplementation';

        $reflectedHasHelpDataProp =
            new ReflectionProperty($abstractHelpHandlerClassName, '_hasHelpData');
        $reflectedHasHelpDataProp->setAccessible(true);

        $willReturnValue = 'Empty help data';

        $methodName = 'getHelpInfo';

        $stubForAbstractHelpHandler = $this
            ->getMockForAbstractClass($abstractHelpHandlerClassName);

        $this->assertFalse($reflectedHasHelpDataProp->getValue($stubForAbstractHelpHandler));

        $this->assertEquals($willReturnValue, $stubForAbstractHelpHandler->{$methodName}());

        // Only for fully covering code by tests
        $reflectedHasHelpDataProp->setValue($stubForAbstractHelpHandler, true);

        $this->assertEquals($willReturnValue, $stubForAbstractHelpHandler->{$methodName}());
    }
}