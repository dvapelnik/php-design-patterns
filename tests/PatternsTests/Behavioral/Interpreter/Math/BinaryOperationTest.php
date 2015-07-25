<?php
namespace PatternsTests\Behavioral\Interpreter\Math;

use Patterns\Behavioral\Interpreter\Math\AbstractBinaryOperator;
use Patterns\Behavioral\Interpreter\Math\ExpressionImplementations\Value;
use PHPUnit_Framework_TestCase;
use ReflectionProperty;

class BinaryOperationTest extends PHPUnit_Framework_TestCase
{
    public function classesProvider()
    {
        return array(
            array(
                'className' => '\Patterns\Behavioral\Interpreter\Math\ExpressionImplementations\Sum',
                'left'      => '1',
                'right'     => '2',
                'result'    => '3',
            ),
            array(
                'className' => '\Patterns\Behavioral\Interpreter\Math\ExpressionImplementations\Difference',
                'left'      => '2',
                'right'     => '1',
                'result'    => '1',
            ),
            array(
                'className' => '\Patterns\Behavioral\Interpreter\Math\ExpressionImplementations\Multiply',
                'left'      => '2',
                'right'     => '3',
                'result'    => '6',
            ),
            array(
                'className' => '\Patterns\Behavioral\Interpreter\Math\ExpressionImplementations\Division',
                'left'      => '10',
                'right'     => '5',
                'result'    => '2',
            ),
        );
    }

    /**
     * @dataProvider classesProvider
     */
    public function testConstructor($className)
    {
        $leftProp = new ReflectionProperty($className, '_left');
        $leftProp->setAccessible(true);
        $rightProp = new ReflectionProperty($className, '_right');
        $rightProp->setAccessible(true);

        $leftExpression = new Value(1);
        $rightExpression = new Value(2);

        /** @var AbstractBinaryOperator $binaryOperationExpression */
        $binaryOperationExpression = new $className($leftExpression, $rightExpression);

        $this->assertSame($leftExpression, $leftProp->getValue($binaryOperationExpression));
        $this->assertSame($rightExpression, $rightProp->getValue($binaryOperationExpression));
    }

    /**
     * @dataProvider classesProvider
     */
    public function testEvaluate($className, $left, $right, $result)
    {
        $this->assertEquals($result, (new $className(new Value($left), new Value($right)))->evaluate());
    }
}