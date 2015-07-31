<?php
namespace PatternsTests\Behavioral\State\Math;

use Patterns\Behavioral\State\Math\AlternatingSeriesEvaluator;
use PHPUnit_Framework_TestCase;

class WorkExampleTest extends PHPUnit_Framework_TestCase
{
    public function evaluatorProvider()
    {
        return array(
            array(1, 1),    // 1
            array(2, 3),    // 1 + 2
            array(3, 0),    // 1 + 2 - 3
            array(4, 4),    // 1 + 2 - 3 + 4
            array(5, -1),   // 1 + 2 - 3 + 4 - 5
            array(6, 5),    // 1 + 2 - 3 + 4 - 5 + 6
            array(7, -2),   // 1 + 2 - 3 + 4 - 5 + 6 - 7
            array(8, 6),    // 1 + 2 - 3 + 4 - 5 + 6 - 7 + 8
            array(9, -3),   // 1 + 2 - 3 + 4 - 5 + 6 - 7 + 8 - 9
            array(10, 7),   // 1 + 2 - 3 + 4 - 5 + 6 - 7 + 8 - 9 + 10
        );
    }

    /**
     * @test
     *
     * @dataProvider evaluatorProvider
     */
    public function work($maxNumber, $sum)
    {
        $evaluator = new AlternatingSeriesEvaluator();

        $result = 1;

        for ($i = 2; $i <= $maxNumber; $i++) {
            $result = $evaluator->evaluate($result, $i);
        }

        $this->assertEquals($sum, $result);
    }
}