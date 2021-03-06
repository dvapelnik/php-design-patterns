<?php
namespace PatternsTests\Creational\Singleton;

use Patterns\Creational\Singleton\Classic\Singleton;
use Patterns\Creational\Singleton\Classic\SingletonA;
use Patterns\Creational\Singleton\Classic\SingletonB;
use PHPUnit_Framework_TestCase;
use ReflectionMethod;

class SingletonTest extends PHPUnit_Framework_TestCase
{
    public function testShouldBeEquals()
    {
        $singletonA1 = SingletonA::GetInstance();
        $singletonA2 = SingletonA::GetInstance();

        $this->assertEquals($singletonA1, $singletonA2);
    }

    public function testShouldBeDifferent()
    {
        $singletonA = SingletonA::GetInstance();
        $singletonB = SingletonB::GetInstance();

        $this->assertNotEquals($singletonA, $singletonB);
    }

    public function testClassNames()
    {
        $singletonA = SingletonA::GetInstance();
        $this->assertInstanceOf('Patterns\Creational\Singleton\Classic\SingletonA', $singletonA);

        $singletonB = SingletonB::GetInstance();
        $this->assertInstanceOf('Patterns\Creational\Singleton\Classic\SingletonB', $singletonB);
    }

    public function testPrivateCloneMethod()
    {
        // Only for fully covering code by tests
        $singleton = Singleton::getInstance();

        $reflectedSingletonCloneMethod = new ReflectionMethod('\Patterns\Creational\Singleton\Classic\Singleton',
            '__clone');
        $reflectedSingletonCloneMethod->setAccessible('true');

        $reflectedSingletonCloneMethod->invoke($singleton);
    }

    public function testPrivateWakeUpMethod()
    {
        // Only for fully covering code by tests
        $singleton = Singleton::getInstance();

        $reflectedSingletonWakeUpMethod = new ReflectionMethod('\Patterns\Creational\Singleton\Classic\Singleton',
            '__wakeup');
        $reflectedSingletonWakeUpMethod->setAccessible('true');

        $reflectedSingletonWakeUpMethod->invoke($singleton);
    }
}