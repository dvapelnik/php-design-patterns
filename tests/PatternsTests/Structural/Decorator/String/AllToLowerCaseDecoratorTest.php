<?php
namespace PatternsTests\Structural\Decorator\String;

use Patterns\Structural\Decorator\String\AllToLowerCaseDecorator;
use Patterns\Structural\Decorator\String\String;
use PHPUnit_Framework_TestCase;

class AllToLowerCaseDecoratorTest extends PHPUnit_Framework_TestCase
{
    public function textProvider()
    {
        return array(
            array('text' => 'somE StRinG', 'expected' => 'some string'),
        );
    }

    /**
     * @dataProvider textProvider
     */
    public function testDecoration($text, $expected)
    {
        $this->assertEquals($expected, (new AllToLowerCaseDecorator(new String($text)))->getText());
    }
}