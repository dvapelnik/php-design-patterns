<?php
namespace Patterns\Behavioral\State\Math;

class PositiveState extends AbstractState
{
    public function evaluate($left, $right, $evaluator)
    {
        $result = $left + $right;

        $evaluator->setState(NegativeState::getInstance());

        return $result;
    }
}