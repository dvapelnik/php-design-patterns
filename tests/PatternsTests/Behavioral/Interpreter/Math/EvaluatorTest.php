<?php
namespace PatternsTests\Behavioral\Interpreter\Math;

use Patterns\Behavioral\Interpreter\Math\Evaluator;
use Patterns\Behavioral\Interpreter\Math\ExpressionImplementations\Difference;
use Patterns\Behavioral\Interpreter\Math\ExpressionImplementations\Division;
use Patterns\Behavioral\Interpreter\Math\ExpressionImplementations\Multiply;
use Patterns\Behavioral\Interpreter\Math\ExpressionImplementations\Sum;
use Patterns\Behavioral\Interpreter\Math\ExpressionImplementations\Value;
use PHPUnit_Framework_TestCase;
use ReflectionMethod;
use ReflectionProperty;

class EvaluatorTest extends PHPUnit_Framework_TestCase
{
    /** @var  ReflectionProperty */
    private $_rawExpressionProp;

    /** @var  ReflectionMethod */
    private $_makeTreeMethod;

    /** @var  ReflectionMethod */
    private $_getRpnExpressionMethod;

    public function setUp()
    {
        $this->_rawExpressionProp = new ReflectionProperty(
            '\Patterns\Behavioral\Interpreter\Math\Evaluator', '_rawExpression');
        $this->_rawExpressionProp->setAccessible(true);

        $this->_makeTreeMethod = new ReflectionMethod(
            '\Patterns\Behavioral\Interpreter\Math\Evaluator',
            '_makeTree');
        $this->_makeTreeMethod->setAccessible(true);

        $this->_getRpnExpressionMethod = new ReflectionMethod(
            '\Patterns\Behavioral\Interpreter\Math\Evaluator',
            '_getRpnExpression');
        $this->_getRpnExpressionMethod->setAccessible(true);
    }

    public function expressionProvider()
    {
        return array(
            array(
                'raw'    => '2 + 2',
                'rpn'    => '2 2 +',
                'result' => '4'
            ),
            array(
                'raw'    => '5*4/10+6*3/9',
                'rpn'    => '5 4 * 10 / 6 3 * 9 / +',
                'result' => '4',
            ),
            array(
                'raw'    => '5+6/2-3',
                'rpn'    => '5 6 2 / + 3 -',
                'result' => '5',
            ),
            array(
                'raw'    => '5+6/(2-3)',
                'rpn'    => '5 6 2 3 - / +',
                'result' => '-1',
            ),
            array(
                'raw'    => '2*((2+16/4) + (6-4)*2+(5+6)+(6-3))',
                'rpn'    => '2 2 16 4 / + 6 4 - 2 * + 5 6 + + 6 3 - + *',
                'result' => '48',
            ),
        );
    }

    /**
     * @dataProvider expressionProvider
     */
    public function testConstructor($raw)
    {
        $evaluator = new Evaluator($raw);

        $this->assertEquals($raw, $this->_rawExpressionProp->getValue($evaluator));
    }

    /**
     * @dataProvider expressionProvider
     */
    public function testGetRpnExpression($raw, $rpn)
    {
        $evaluator = new Evaluator($raw);

        $this->assertEquals($rpn, $this->_getRpnExpressionMethod->invoke($evaluator, $raw));
    }

    public function testMakeTreeCorrect()
    {
        $expectedTree = new Sum(new Value(1), new Value(2));
        $this->assertEquals($expectedTree, $this->_makeTreeMethod->invoke(new Evaluator('1 + 2')));

        $expectedTree = new Difference(new Value(2), new Value(1));
        $this->assertEquals($expectedTree, $this->_makeTreeMethod->invoke(new Evaluator('2 - 1')));

        $expectedTree = new Multiply(new Value(2), new Value(3));
        $this->assertEquals($expectedTree, $this->_makeTreeMethod->invoke(new Evaluator('2 * 3')));

        $expectedTree = new Division(new Value(4), new Value(2));
        $this->assertEquals($expectedTree, $this->_makeTreeMethod->invoke(new Evaluator('4 / 2')));

        $expectedTree = new Division(new Value(10), new Sum(new Value(2), new Value(3)));
        $this->assertEquals($expectedTree, $this->_makeTreeMethod->invoke(new Evaluator('10 / (2 + 3)')));
    }

    /**
     * @dataProvider expressionProvider
     */
    public function testEvaluate($raw, $rpn, $result)
    {
        $this->assertEquals($result, (new Evaluator($raw))->evaluate());
    }
}