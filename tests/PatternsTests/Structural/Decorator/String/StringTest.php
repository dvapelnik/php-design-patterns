<?php
namespace PatternsTests\Structural\Decorator\String;

use Patterns\Structural\Decorator\String\String;
use PHPUnit_Framework_TestCase;
use ReflectionClass;
use ReflectionProperty;

class StringTest extends PHPUnit_Framework_TestCase
{
    /** @var  ReflectionClass */
    private $_reflectedStringClass;

    /** @var  ReflectionProperty */
    private $_reflectedStringClassTextProperty;

    public function setUp()
    {
        $this->_reflectedStringClass = new ReflectionClass(
            '\Patterns\Structural\Decorator\String\String');

        $this->_reflectedStringClassTextProperty = $this->_reflectedStringClass->getProperty('_text');
        $this->_reflectedStringClassTextProperty->setAccessible(true);
    }

    public function testConstructor()
    {
        $_text = 'foo';

        $string = new String($_text);

        $this->assertEquals($_text, $this->_reflectedStringClassTextProperty->getValue($string));
    }

    public function testGetText()
    {
        $_text = 'foo';

        $string = new String($_text);

        $this->assertEquals($_text, $string->getText());
    }
}