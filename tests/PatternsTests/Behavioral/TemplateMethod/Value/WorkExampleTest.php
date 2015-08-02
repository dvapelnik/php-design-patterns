<?php
namespace PatternsTests\Behavioral\TemplateMethod\Value;

use Patterns\Behavioral\TemplateMethod\Value\AbsoluteValue;
use Patterns\Behavioral\TemplateMethod\Value\Value;
use PHPUnit_Framework_TestCase;

class WorkExampleTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function workWithValue()
    {
        $value = new Value(0);
        $this->assertEquals(0, $value->getCountOfSetValue());

        $value->setValue(1);
        $this->assertEquals(1, $value->getCountOfSetValue());
    }

    /**
     * @test
     */
    public function workWithAbsoluteValue()
    {
        $value = new AbsoluteValue(0);
        $this->assertEquals(0, $value->getCountOfSetValue());

        $value->setValue(1);
        $this->assertEquals(1, $value->getCountOfSetValue());
    }
}