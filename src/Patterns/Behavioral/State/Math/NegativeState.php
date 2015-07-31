<?php
namespace Patterns\Behavioral\State\Math;

class NegativeState extends AbstractState
{
    public function evaluate($left, $right, $evaluator)
    {
        $result = $left - $right;

        $evaluator->setState(PositiveState::getInstance());

        return $result;
    }
}