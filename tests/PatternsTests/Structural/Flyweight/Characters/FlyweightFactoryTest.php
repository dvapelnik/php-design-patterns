<?php
namespace PatternsTests\Structural\Flyweight\Characters;

use Patterns\Structural\Flyweight\Characters\FlyweightFactory;
use PHPUnit_Framework_TestCase;
use ReflectionClass;
use ReflectionProperty;

class FlyweightFactoryTest extends PHPUnit_Framework_TestCase
{
    /** @var  FlyweightFactory */
    private $_flyweightFactory;

    /** @var  ReflectionClass */
    private $_reflectedFlyweightFactory;

    /** @var  ReflectionProperty */
    private $_reflectedFlyweightsPool;

    public function setUp()
    {
        $this->_flyweightFactory = FlyweightFactory::GetInstance();

        $this->_reflectedFlyweightFactory = new ReflectionClass(
            '\Patterns\Structural\Flyweight\Characters\FlyweightFactory');

        $this->_reflectedFlyweightsPool =
            $this->_reflectedFlyweightFactory->getProperty('_flyweights');

        $this->_reflectedFlyweightsPool->setAccessible(true);

        $this->_reflectedFlyweightsPool->setValue($this->_flyweightFactory, null);
    }

    public function testFactoryCreatedWithNullPollFirstly()
    {
        $reflectedClass = new ReflectionClass(
            '\Patterns\Structural\Flyweight\Characters\FlyweightFactory');

        $flyweightFactory = $reflectedClass->newInstanceWithoutConstructor();

        $reflectedPoolProp = $reflectedClass->getProperty('_flyweights');
        $reflectedPoolProp->setAccessible(true);

        $this->assertNull($reflectedPoolProp->getValue($flyweightFactory));
    }

    public function testFactory()
    {
        $flyChar = $this->_flyweightFactory->getFlyweight('f');

        $this->assertInstanceOf(
            '\Patterns\Structural\Flyweight\Characters\FlyweightCharacter',
            $flyChar);

        $flyWord = $this->_flyweightFactory->getFlyweight('foo');

        $this->assertInstanceOf(
            '\Patterns\Structural\Flyweight\Characters\FlyweightWord',
            $flyWord);

        $flyString = $this->_flyweightFactory->getFlyweight('foo bar');

        $this->assertInstanceOf(
            '\Patterns\Structural\Flyweight\Characters\FlyweightString',
            $flyString);
    }

    public function testFlyweightsPool()
    {
        $expectedPool = array();

        $charF = 'F';
        $wordFoo = 'FOO';
        $stringFooBar = 'FOO BAR';

        $flyCharF = $this->_flyweightFactory->getFlyweight($charF);

        $expectedPool[$charF] = $flyCharF;

        $this->assertEquals(
            $expectedPool,
            $this->_reflectedFlyweightsPool->getValue($this->_flyweightFactory));

        $flyWordFoo = $this->_flyweightFactory->getFlyweight($wordFoo);

        $expectedPool['O'] = $this->_flyweightFactory->getFlyweight('O');

        $expectedPool['FOO'] = $flyWordFoo;

        $this->assertEquals(
            $expectedPool,
            $this->_reflectedFlyweightsPool->getValue($this->_flyweightFactory));

        $flyStringFooBar = $this->_flyweightFactory->getFlyweight($stringFooBar);

        $expectedPool['B'] = $this->_flyweightFactory->getFlyweight('B');
        $expectedPool['A'] = $this->_flyweightFactory->getFlyweight('A');
        $expectedPool['R'] = $this->_flyweightFactory->getFlyweight('R');

        $expectedPool['BAR'] = $this->_flyweightFactory->getFlyweight('BAR');

        $expectedPool['FOO BAR'] = $flyStringFooBar;

        $this->assertEquals(
            $expectedPool,
            $this->_reflectedFlyweightsPool->getValue($this->_flyweightFactory));
    }

    public function testFlyweightsPoolUniqueChars()
    {
        $charF = 'F';

        $flyCharF1 = $this->_flyweightFactory->getFlyweight($charF);

        $countAfterF1 = count($this->_reflectedFlyweightsPool->getValue($this->_flyweightFactory));

        $flyCharF2 = $this->_flyweightFactory->getFlyweight($charF);

        $countAfterF2 = count($this->_reflectedFlyweightsPool->getValue($this->_flyweightFactory));

        $this->assertEquals($countAfterF1, $countAfterF2);
    }

    public function testFlyweightsPoolUniqueWords()
    {
        $wordFoo = 'FOO';

        $flyWord1 = $this->_flyweightFactory->getFlyweight($wordFoo);

        $countAfterFoo1 = count($this->_reflectedFlyweightsPool->getValue($this->_flyweightFactory));

        $flyWord2 = $this->_flyweightFactory->getFlyweight($wordFoo);

        $countAfterFoo2 = count($this->_reflectedFlyweightsPool->getValue($this->_flyweightFactory));

        $this->assertEquals($countAfterFoo1, $countAfterFoo2);
    }

    public function testFlyweightsPoolUniqueStrings()
    {
        $stringFooBar = 'FOO BAR';

        $flyString1 = $this->_flyweightFactory->getFlyweight($stringFooBar);

        $countAfterFooBar1 = count($this->_reflectedFlyweightsPool->getValue($this->_flyweightFactory));

        $flyString2 = $this->_flyweightFactory->getFlyweight($stringFooBar);

        $countAfterFooBar2 = count($this->_reflectedFlyweightsPool->getValue($this->_flyweightFactory));

        $this->assertEquals($countAfterFooBar1, $countAfterFooBar2);
    }

    public function testFlyweightsPoolCharsIsSame()
    {
        $charF = 'F';

        $flyCharF1 = $this->_flyweightFactory->getFlyweight($charF);
        $flyCharF2 = $this->_flyweightFactory->getFlyweight($charF);

        $this->assertSame($flyCharF1, $flyCharF2);

        $factoryPool = $this->_reflectedFlyweightsPool->getValue($this->_flyweightFactory);

        $this->assertSame($flyCharF1, $factoryPool[$charF]);
        $this->assertSame($flyCharF2, $factoryPool[$charF]);
    }

    public function testFlyweightsPoolWordsIsSame()
    {
        $wordFoo = 'FOO';

        $flyWordFoo1 = $this->_flyweightFactory->getFlyweight($wordFoo);
        $flyWordFoo2 = $this->_flyweightFactory->getFlyweight($wordFoo);

        $factoryPool = $this->_reflectedFlyweightsPool->getValue($this->_flyweightFactory);

        $this->assertSame($flyWordFoo1, $flyWordFoo2);
        $this->assertSame($flyWordFoo1, $factoryPool[$wordFoo]);
        $this->assertSame($flyWordFoo2, $factoryPool[$wordFoo]);
    }

    public function testFlyweightsPoolStringsIsSame()
    {
        $stringFooBar = 'FOO BAR';

        $flyStringFooBar1 = $this->_flyweightFactory->getFlyweight($stringFooBar);
        $flyStringFooBar2 = $this->_flyweightFactory->getFlyweight($stringFooBar);

        $factoryPool = $this->_reflectedFlyweightsPool->getValue($this->_flyweightFactory);

        $this->assertSame($flyStringFooBar1, $flyStringFooBar2);
        $this->assertSame($flyStringFooBar1, $factoryPool[$stringFooBar]);
        $this->assertSame($flyStringFooBar2, $factoryPool[$stringFooBar]);
    }
}