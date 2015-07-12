<?php
namespace PatternsTests\Structural\Flyweight\Characters;

use Patterns\Structural\Flyweight\Characters\FlyweightWord;

class FlyweightWordTest extends AbstractFlyweightTest
{
    public function testConstructor()
    {
        $word = 'foo';

        $reflectedCharactersProperty = $this->getReflectedProperty(
            '\Patterns\Structural\Flyweight\Characters\FlyweightWord',
            '_characters');

        $flyCharsArray = array();

        $flyweightFactoryStub = $this->getFlyweightFactoryStub(
            $word,
            $flyCharsArray,
            'Patterns\Structural\Flyweight\Characters\FlyweightCharacter');

        $flyWord = new FlyweightWord($word, $flyweightFactoryStub);

        $this->assertEquals($flyCharsArray, $reflectedCharactersProperty->getValue($flyWord));
    }

    public function testGetString()
    {
        $word = 'foo';

        $flyWord = new FlyweightWord($word, $this->getFlyweightFactoryStub($word));

        $this->assertEquals($word, $flyWord->getString());
    }
}