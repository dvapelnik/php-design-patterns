<?php
namespace PatternsTests\Behavioral\State\Math;

use Patterns\Behavioral\State\Math\AlternatingSeriesEvaluator;
use Patterns\Behavioral\State\Math\PositiveState;
use PHPUnit_Framework_TestCase;
use ReflectionProperty;

class AlternatingSeriesEvaluatorTest extends PHPUnit_Framework_TestCase
{
    private $_positiveStateStub;
    private $_negativeStateStub;
    /** @var  ReflectionProperty */
    private $_reflectedStateProp;

    public function setUp()
    {
        $this->_reflectedStateProp = new ReflectionProperty(
            '\Patterns\Behavioral\State\Math\AlternatingSeriesEvaluator',
            '_state');
        $this->_reflectedStateProp->setAccessible(true);

        $this->_positiveStateStub = $this->getMockBuilder('\Patterns\Behavioral\State\Math\PositiveState')
            ->disableOriginalConstructor()
            ->getMock();

        $this->_negativeStateStub = $this->getMockBuilder('\Patterns\Behavioral\State\Math\NegativeState')
            ->disableOriginalConstructor()
            ->getMock();
    }

    public function testConstructor()
    {
        $evaluator = new AlternatingSeriesEvaluator();

        $this->assertSame(PositiveState::getInstance(), $this->_reflectedStateProp->getValue($evaluator));

        return $evaluator;
    }

    /**
     * @depends testConstructor
     *
     * @param $evaluator AlternatingSeriesEvaluator
     */
    public function testSetState($evaluator)
    {
        $evaluator->setState($this->_positiveStateStub);
        $this->assertSame($this->_positiveStateStub, $this->_reflectedStateProp->getValue($evaluator));

        $evaluator->setState($this->_negativeStateStub);
        $this->assertSame($this->_negativeStateStub, $this->_reflectedStateProp->getValue($evaluator));
    }

    /**
     * @depends testConstructor
     *
     * @param $evaluator AlternatingSeriesEvaluator
     */
    public function testEvaluate($evaluator)
    {
        $stubMaps = array(
            'positive' => array(
                array(1, 1, $evaluator, 2),
                array(2, 3, $evaluator, 5),
            ),
            'negative' => array(
                array(1, 1, $evaluator, 0),
                array(2, 1, $evaluator, 1),
            ),
        );

        $this->_positiveStateStub->method('evaluate')->will($this->returnValueMap($stubMaps['positive']));
        $this->_negativeStateStub->method('evaluate')->will($this->returnValueMap($stubMaps['negative']));

        $evaluator->setState($this->_positiveStateStub);
        foreach ($stubMaps['positive'] as $map) {
            $this->assertEquals($map[3], $evaluator->evaluate($map[0], $map[1]));
        }

        $evaluator->setState($this->_negativeStateStub);
        foreach ($stubMaps['negative'] as $map) {
            $this->assertEquals($map[3], $evaluator->evaluate($map[0], $map[1]));
        }
    }
}