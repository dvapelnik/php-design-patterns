<?php
namespace Patterns\Behavioral\Interpreter\Math\ExpressionImplementations;

use Patterns\Behavioral\Interpreter\Math\ExpressionInterface;

class Value implements ExpressionInterface
{
    private $_value;

    public function __construct($value)
    {
        $this->_value = $value;
    }

    public function evaluate()
    {
        return $this->_value;
    }
}