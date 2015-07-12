<?php
namespace PatternsTests\Structural\Flyweight\Characters;

use Patterns\Structural\Flyweight\Characters\FlyweightString;

class FlyweightStringTest extends AbstractFlyweightTest
{
    public function testConstructor()
    {
        $string = 'foo bar';

        $reflectedWordsProperty = $this->getReflectedProperty(
            '\Patterns\Structural\Flyweight\Characters\FlyweightString',
            '_words');

        $wordsArray = array();

        $flyweightFactoryStub = $this->getFlyweightFactoryStub(
            $string,
            $wordsArray,
            'Patterns\Structural\Flyweight\Characters\FlyweightWord');

        $flyString = new FlyweightString($string, $flyweightFactoryStub);

        $this->assertEquals($wordsArray, $reflectedWordsProperty->getValue($flyString));
    }

    public function testGetString()
    {
        $string = 'foo bar';

        $flyString = new FlyweightString($string, $this->getFlyweightFactoryStub($string));

        $this->assertEquals($string, $flyString->getString());
    }
}