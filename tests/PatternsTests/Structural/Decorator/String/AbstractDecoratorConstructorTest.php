<?php
namespace PatternsTests\Structural\Decorator\String;

use Patterns\Structural\Decorator\String\AllToLowerCaseDecorator;
use Patterns\Structural\Decorator\String\String;
use PHPUnit_Framework_TestCase;
use ReflectionClass;
use ReflectionProperty;

class AbstractDecoratorConstructorTest extends PHPUnit_Framework_TestCase
{
    /** @var  ReflectionClass */
    private $_reflectedDecoratorClass;

    /** @var  ReflectionProperty */
    private $_reflectedDecoratorTargetProperty;

    public function setUp()
    {
        $this->_reflectedDecoratorClass = new ReflectionClass(
            '\Patterns\Structural\Decorator\String\AbstractDecorator');

        $this->_reflectedDecoratorTargetProperty =
            $this->_reflectedDecoratorClass->getProperty('_getTextObject');
        $this->_reflectedDecoratorTargetProperty->setAccessible(true);
    }

    public function decoratorClassProvider()
    {
        return array(
            array('\Patterns\Structural\Decorator\String\ToCamelCaseDecorator'),
            array('\Patterns\Structural\Decorator\String\AllToLowerCaseDecorator'),
        );
    }

    /**
     * @dataProvider decoratorClassProvider
     */
    public function testConstructor($decoratorClass)
    {
        $_text = 'somE StRinG';

        $string = new String($_text);

        $decorator = new $decoratorClass($string);

        $this->assertSame($string, $this->_reflectedDecoratorTargetProperty->getValue($decorator));
    }
}