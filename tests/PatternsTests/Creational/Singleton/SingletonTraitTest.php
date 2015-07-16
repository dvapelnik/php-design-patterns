<?php
namespace PatternsTests\Creational\Singleton;

use PatternsTests\Creational\Singleton\Dummies\SingletonTraitedDummy;
use PatternsTests\Creational\Singleton\Dummies\SingletonTraitedDummyA;
use PatternsTests\Creational\Singleton\Dummies\SingletonTraitedDummyB;
use PHPUnit_Framework_TestCase;
use ReflectionMethod;

class SingletonTraitTest extends PHPUnit_Framework_TestCase
{
    public function testShouldBeEquals()
    {
        $this->assertEquals(SingletonTraitedDummyA::getInstance(), SingletonTraitedDummyA::getInstance());
        $this->assertEquals(SingletonTraitedDummyB::getInstance(), SingletonTraitedDummyB::getInstance());
    }

    public function testShouldBeInstanceOf()
    {
        $this->assertInstanceOf(
            'PatternsTests\Creational\Singleton\Dummies\SingletonTraitedDummyA',
            SingletonTraitedDummyA::getInstance());

        $this->assertInstanceOf(
            'PatternsTests\Creational\Singleton\Dummies\SingletonTraitedDummyB',
            SingletonTraitedDummyB::getInstance());
    }

    public function testShouldBeDifferent()
    {
        $this->assertNotEquals(
            SingletonTraitedDummyA::getInstance(),
            SingletonTraitedDummyB::getInstance()
        );
    }

    public function testPrivateCloneMethod()
    {
        // Only for fully covering code by tests
        $singleton = SingletonTraitedDummy::getInstance();

        $reflectedSingletonCloneMethod =
            new ReflectionMethod(
                '\PatternsTests\Creational\Singleton\Dummies\SingletonTraitedDummy',
                '__clone');
        $reflectedSingletonCloneMethod->setAccessible('true');

        $reflectedSingletonCloneMethod->invoke($singleton);
    }

    public function testPrivateWakeUpMethod()
    {
        // Only for fully covering code by tests
        $singleton = SingletonTraitedDummy::getInstance();

        $reflectedSingletonWakeUpMethod =
            new ReflectionMethod(
                '\PatternsTests\Creational\Singleton\Dummies\SingletonTraitedDummy',
                '__wakeup');
        $reflectedSingletonWakeUpMethod->setAccessible('true');

        $reflectedSingletonWakeUpMethod->invoke($singleton);
    }
}