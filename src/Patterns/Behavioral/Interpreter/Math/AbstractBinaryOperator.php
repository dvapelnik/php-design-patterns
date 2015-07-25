<?php
namespace Patterns\Behavioral\Interpreter\Math;

abstract class AbstractBinaryOperator implements ExpressionInterface
{
    /**
     * @var ExpressionInterface
     */
    protected $_left;

    /**
     * @var ExpressionInterface
     */
    protected $_right;

    /**
     * Sum constructor.
     */
    public function __construct(ExpressionInterface $left, ExpressionInterface $right)
    {
        $this->_left = $left;
        $this->_right = $right;
    }
}