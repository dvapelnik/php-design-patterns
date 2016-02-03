<?php
namespace PatternsTests\Structural\Decorator\String;

use Patterns\Structural\Decorator\String\AllToLowerCaseDecorator;
use Patterns\Structural\Decorator\String\MyString;
use Patterns\Structural\Decorator\String\ToCamelCaseDecorator;
use PHPUnit_Framework_TestCase;

class CombineTest extends PHPUnit_Framework_TestCase
{
    public function testCamelCaseAndLowerCase()
    {
        $_text = ' soMe tExT StrIng';
        $_expected = 'sometextstring';

        $this->assertEquals($_expected,
            (new AllToLowerCaseDecorator(
                new ToCamelCaseDecorator(
                    new MyString($_text)
                )
            )
            )->getText()
        );
    }

    public function testLowerCaseAndCamelCase()
    {
        $_text = ' soMe tExT StrIng';
        $_expected = 'someTextString';

        $this->assertEquals($_expected,
            (new ToCamelCaseDecorator(
                new AllToLowerCaseDecorator(
                    new MyString($_text)
                )
            )
            )->getText()
        );
    }
}