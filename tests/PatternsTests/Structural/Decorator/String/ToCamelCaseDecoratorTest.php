<?php
namespace PatternsTests\Structural\Decorator\String;

use Patterns\Structural\Decorator\String\String;
use Patterns\Structural\Decorator\String\ToCamelCaseDecorator;
use PHPUnit_Framework_TestCase;

class ToCamelCaseDecoratorTest extends PHPUnit_Framework_TestCase
{
    public function textProvider()
    {
        return array(
            array('text' => 'somE StRinG', 'expected' => 'somEStRinG'),
            array('text' => 'somE', 'expected' => 'somE'),
        );
    }

    /**
     * @dataProvider textProvider
     */
    public function testDecoration($text, $expected)
    {
        $this->assertEquals($expected, (new ToCamelCaseDecorator(new String($text)))->getText());
    }
}