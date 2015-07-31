<?php
namespace Patterns\Behavioral\State\Math;

use Patterns\Creational\Singleton\SingletonTrait;

abstract class AbstractState
{
    use SingletonTrait;

    /**
     * @param $left int
     * @param $right int
     * @param $evaluator AlternatingSeriesEvaluator
     *
     * @return int
     */
    abstract public function evaluate($left, $right, $evaluator);
}