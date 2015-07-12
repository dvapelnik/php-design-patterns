<?php
namespace PatternsTests\Structural\Flyweight\Characters;

use Patterns\Structural\Flyweight\Characters\FlyweightCharacter;
use Patterns\Structural\Flyweight\Characters\FlyweightWord;
use PHPUnit_Framework_TestCase;
use ReflectionClass;
use ReflectionProperty;

abstract class AbstractFlyweightTest extends PHPUnit_Framework_TestCase
{
    protected function getFlyweightFactoryStub($string, &$flyPropArray = null, $filterFlyPropClass = null)
    {
        $flyweightFactoryStub = $this
            ->getMockBuilder('\Patterns\Structural\Flyweight\Characters\FlyweightFactory')
            ->disableOriginalConstructor()
            ->getMock();

        $getFlyWeightMethodStub = $flyweightFactoryStub
            ->method('getFlyweight');

        $map = array();

        $unSpacedString = preg_replace('/\s+/', '', $string);

        for ($i = 0; $i < strlen($unSpacedString); $i++) {
            $map[] = array($unSpacedString[$i], new FlyweightCharacter($unSpacedString[$i]));
        }

        $getFlyWeightMethodStub
            ->will($this->returnValueMap($map));

        if (preg_match('/\s/', $string)) {
            $words = preg_split('/\s+/', $string);

            foreach ($words as $word) {
                $map[] = array($word, new FlyweightWord($word, $flyweightFactoryStub));
            }
        }

        $getFlyWeightMethodStub
            ->will($this->returnValueMap($map));

        if ($flyPropArray !== null) {
            $_tmpFlyPropArray = array_map(function ($args) {
                return $args[1];
            }, array_filter($map, function ($args) use ($filterFlyPropClass) {
                return get_class($args[1]) === $filterFlyPropClass;
            }));

            foreach ($_tmpFlyPropArray as $_tmpFlyProp) {
                $flyPropArray[] = $_tmpFlyProp;
            }
        }

        return $flyweightFactoryStub;
    }

    /**
     * @return ReflectionProperty
     */
    protected function getReflectedProperty($className, $propertyName)
    {
        $reflectedFlyweightCharacterClass =
            new ReflectionClass($className);

        $reflectedCharactersProperty = $reflectedFlyweightCharacterClass->getProperty($propertyName);
        $reflectedCharactersProperty->setAccessible(true);

        return $reflectedCharactersProperty;
    }
}