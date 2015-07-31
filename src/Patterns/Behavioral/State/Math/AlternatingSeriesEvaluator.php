<?php
namespace Patterns\Behavioral\State\Math;

/**
 * Class AlternatingSeriesEvaluator
 * @package Patterns\Behavioral\State\Math
 *
 * Alternating series is series like a 1 + 2 - 3 + 4 - 5 + 6
 */
class AlternatingSeriesEvaluator
{
    /** @var  AbstractState */
    private $_state;

    /**
     * AlternatingSeriesEvaluator constructor.
     */
    public function __construct()
    {
        $this->_state = PositiveState::getInstance();
    }

    public function setState(AbstractState $state)
    {
        $this->_state = $state;
    }

    public function evaluate($left, $right)
    {
        return $this->_state->evaluate($left, $right, $this);
    }
}