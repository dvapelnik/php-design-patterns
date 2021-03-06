<?php
namespace Patterns\Behavioral\Interpreter\Math\ExpressionImplementations;

use Patterns\Behavioral\Interpreter\Math\AbstractBinaryOperator;

class Multiply extends AbstractBinaryOperator
{
    public function evaluate()
    {
        return $this->_left->evaluate() * $this->_right->evaluate();
    }
}