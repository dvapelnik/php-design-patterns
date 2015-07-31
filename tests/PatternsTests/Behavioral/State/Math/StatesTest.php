<?php
namespace PatternsTests\Behavioral\State\Math;

use Patterns\Behavioral\State\Math\PositiveState;
use Patterns\Behavioral\State\Math\NegativeState;
use PHPUnit_Framework_TestCase;

class StatesTest extends PHPUnit_Framework_TestCase
{
    private $_evaluatorStub;

    public function setUp()
    {
        $this->_evaluatorStub =
            $this->getMockBuilder('\Patterns\Behavioral\State\Math\AlternatingSeriesEvaluator')
                ->disableOriginalConstructor()
                ->getMock();

        $this->_evaluatorStub->method('setState')->willReturn(null);
    }

    public function positiveProvider()
    {
        return array(
            array(1, 2, 3),
            array(4, 5, 9),
            array(6, 7, 13),
        );
    }

    public function negativeProvider()
    {
        return array(
            array(1, 2, -1),
            array(4, 5, -1),
            array(6, 7, -1),
        );
    }

    /**
     * @dataProvider positiveProvider
     */
    public function testEvaluateOnPositive($left, $right, $result)
    {
        $this->assertEquals(
            $result,
            PositiveState::getInstance()->evaluate($left, $right, $this->_evaluatorStub));
    }

    /**
     * @dataProvider negativeProvider
     */
    public function testEvaluateOnNegative($left, $right, $result)
    {
        $this->assertEquals(
            $result,
            NegativeState::getInstance()->evaluate($left, $right, $this->_evaluatorStub));
    }
}