<?php
namespace PatternsTests\Behavioral\ChainOfResponsibility\HelpInfo\CompositionImplementation;

use Patterns\Behavioral\ChainOfResponsibility\HelpInfo\CompositionImplementation\HelpHandlerInterface;
use PHPUnit_Framework_TestCase;
use ReflectionProperty;

class GeneralHelpHandlerTest extends PHPUnit_Framework_TestCase
{
    public function helpHandlerClassesProvider()
    {
        return array(
            array(
                'helpHandlerClassName' =>
                    '\Patterns\Behavioral\ChainOfResponsibility' .
                    '\HelpInfo\CompositionImplementation\DefaultHelpHandler'
            ),
            array(
                'helpHandlerClassName' =>
                    '\Patterns\Behavioral\ChainOfResponsibility' .
                    '\HelpInfo\CompositionImplementation\EmptyHelpHandler'
            ),
            array(
                'helpHandlerClassName' =>
                    '\Patterns\Behavioral\ChainOfResponsibility' .
                    '\HelpInfo\CompositionImplementation\ValidHelpHandler'
            ),
        );
    }

    private function getReflectedProperty($className, $propName, $accessible = true)
    {
        $reflectedProp = new ReflectionProperty($className, $propName);

        $reflectedProp->setAccessible($accessible);

        return $reflectedProp;
    }

    /**
     * @dataProvider helpHandlerClassesProvider
     */
    public function testSetNextHelpHandler($helpHandlerClassName)
    {
        /** @var HelpHandlerInterface $nextHelpHandler */
        $nextHelpHandler = new $helpHandlerClassName();

        /** @var HelpHandlerInterface $currentHelpHandler */
        $currentHelpHandler = new $helpHandlerClassName();

        $this->assertNotSame($nextHelpHandler, $currentHelpHandler);

        $reflectedHelpHandlerNextHelpHandlerProp =
            $this->getReflectedProperty($helpHandlerClassName, '_nextHelpHandler');

        $this->assertNull($reflectedHelpHandlerNextHelpHandlerProp->getValue($currentHelpHandler));

        $currentHelpHandler->setNextHelpHandler($nextHelpHandler);

        $this->assertSame(
            $nextHelpHandler,
            $reflectedHelpHandlerNextHelpHandlerProp->getValue($currentHelpHandler));
    }

    /**
     * @dataProvider helpHandlerClassesProvider
     */
    public function testGetHelpInfoWithOwnData($helpHandlerClassName)
    {
        /** @var HelpHandlerInterface $helpHandler */
        $helpHandler = new $helpHandlerClassName();

        $reflectedHelpHandlerHelpDataProp =
            $this->getReflectedProperty($helpHandlerClassName, '_helpData');

        $this->assertEquals(
            $reflectedHelpHandlerHelpDataProp->getValue($helpHandler),
            $helpHandler->getHelpInfo());
    }

    /**
     * @dataProvider helpHandlerClassesProvider
     */
    public function testGetHelpInfoFromNextInfoHelperData($helpHandlerClassName)
    {
        /** @var HelpHandlerInterface $currentHelpHandler */
        $currentHelpHandler = new $helpHandlerClassName();

        /** @var HelpHandlerInterface $nextHelpHandler */
        $nextHelpHandler = new $helpHandlerClassName();

        $currentHelpHandler->setNextHelpHandler($nextHelpHandler);

        $this->assertNotSame($nextHelpHandler, $currentHelpHandler);

        $reflectedHelpHandlerHelpDataProp =
            $this->getReflectedProperty($helpHandlerClassName, '_helpData');

        $reflectedHelpHandlerHelpDataProp->setValue($currentHelpHandler, null);

        $this->assertEquals(
            $reflectedHelpHandlerHelpDataProp->getValue($nextHelpHandler),
            $currentHelpHandler->getHelpInfo());
    }

    /**
     * @dataProvider helpHandlerClassesProvider
     */
    public function testGetHelpInfoAsDefaultData($helpHandlerClassName)
    {
        /** @var HelpHandlerInterface $helpHandler */
        $helpHandler = new $helpHandlerClassName();

        $reflectedHelpHandlerHelpDataProp =
            $this->getReflectedProperty($helpHandlerClassName, '_helpData');

        $reflectedHelpHandlerHelpDataProp->setValue($helpHandler, null);

        $reflectedHelpHandlerDefaultHelpDataProp =
            $this->getReflectedProperty($helpHandlerClassName, '_defaultHelpData');

        $this->assertEquals(
            $reflectedHelpHandlerDefaultHelpDataProp->getValue($helpHandler),
            $helpHandler->getHelpInfo());
    }
}