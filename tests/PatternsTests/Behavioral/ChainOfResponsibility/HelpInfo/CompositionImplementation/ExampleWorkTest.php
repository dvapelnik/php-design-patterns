<?php
namespace PatternsTests\Behavioral\ChainOfResponsibility\HelpInfo\CompositionImplementation;

use Patterns\Behavioral\ChainOfResponsibility\HelpInfo\CompositionImplementation\DefaultHelpHandler;
use Patterns\Behavioral\ChainOfResponsibility\HelpInfo\CompositionImplementation\EmptyHelpHandler;
use Patterns\Behavioral\ChainOfResponsibility\HelpInfo\CompositionImplementation\ValidHelpHandler;
use PHPUnit_Framework_TestCase;
use ReflectionProperty;

class ExampleWorkTest extends PHPUnit_Framework_TestCase
{
    public function testRun()
    {
        $defaultHelpHandler = new DefaultHelpHandler();
        $emptyHelpHandler = new EmptyHelpHandler();
        $validHelpHandler = new ValidHelpHandler();

        $validHelpHandler->setNextHelpHandler($emptyHelpHandler);
        $emptyHelpHandler->setNextHelpHandler($defaultHelpHandler);

        $reflectedValidHelpHandlerHelpDataProp =
            new ReflectionProperty(
                '\Patterns\Behavioral\ChainOfResponsibility\HelpInfo' .
                '\CompositionImplementation\ValidHelpHandler',
                '_helpData');
        $reflectedValidHelpHandlerHelpDataProp->setAccessible(true);

        $reflectedEmptyHelpHandlerHelpDataProp =
            new ReflectionProperty(
                '\Patterns\Behavioral\ChainOfResponsibility\HelpInfo' .
                '\CompositionImplementation\EmptyHelpHandler',
                '_helpData');
        $reflectedEmptyHelpHandlerHelpDataProp->setAccessible(true);

        $reflectedDefaultHelpHandlerHelpDataProp =
            new ReflectionProperty(
                '\Patterns\Behavioral\ChainOfResponsibility\HelpInfo' .
                '\CompositionImplementation\DefaultHelpHandler',
                '_helpData');
        $reflectedDefaultHelpHandlerHelpDataProp->setAccessible(true);

        $reflectedDefaultHelpHandlerDefaultHelpDataProp =
            new ReflectionProperty(
                '\Patterns\Behavioral\ChainOfResponsibility\HelpInfo' .
                '\CompositionImplementation\DefaultHelpHandler',
                '_defaultHelpData');
        $reflectedDefaultHelpHandlerDefaultHelpDataProp->setAccessible(true);

        // All right $validHelpHandler should return own help data
        $this->assertEquals(
            $reflectedValidHelpHandlerHelpDataProp->getValue($validHelpHandler),
            $validHelpHandler->getHelpInfo());

        // Set help data on $validHelpHandler as null
        $reflectedValidHelpHandlerHelpDataProp->setValue($validHelpHandler, null);

        // $validHelpHandler should invoke $emptyHelpHandler and return him help data
        $this->assertEquals(
            $reflectedEmptyHelpHandlerHelpDataProp->getValue($emptyHelpHandler),
            $validHelpHandler->getHelpInfo());

        // Set help data on $emptyHelpHandler as null
        $reflectedEmptyHelpHandlerHelpDataProp->setValue($emptyHelpHandler, null);

        // Set help data on $defaultHelpHandler as null
        $reflectedDefaultHelpHandlerHelpDataProp->setValue($defaultHelpHandler, null);

        // $validHelpHandler should invoke $emptyHelpHandler
        // $emptyHelpHandler should invoke next: $defaultHelpHandler
        // $defaultHelpHandler have not next help handler and should return own default help data
        $this->assertEquals(
            $reflectedDefaultHelpHandlerDefaultHelpDataProp->getValue($defaultHelpHandler),
            $validHelpHandler->getHelpInfo());
    }
}