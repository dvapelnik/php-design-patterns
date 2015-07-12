<?php
namespace PatternsTests\Structural\Flyweight\Characters;

use Patterns\Structural\Flyweight\Characters\FlyweightCharacter;
use PHPUnit_Framework_TestCase;
use ReflectionClass;

class FlyweightCharacterTest extends PHPUnit_Framework_TestCase
{
    public function testConstructor()
    {
        $reflectedFlyweightCharacterClass =
            new ReflectionClass('\Patterns\Structural\Flyweight\Characters\FlyweightCharacter');

        $reflectedCharProperty = $reflectedFlyweightCharacterClass->getProperty('_char');
        $reflectedCharProperty->setAccessible(true);

        $char = 'f';

        $flyChar = new FlyweightCharacter($char);

        $this->assertEquals($char, $reflectedCharProperty->getValue($flyChar));
    }

    public function testGetString()
    {
        $char = 'f';

        $flyChar = new FlyweightCharacter($char);

        $this->assertEquals($char, $flyChar->getString());
    }
}