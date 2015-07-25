<?php
namespace Patterns\Behavioral\Interpreter\Math;

use Exception;
use Patterns\Behavioral\Interpreter\Math\ExpressionImplementations\Difference;
use Patterns\Behavioral\Interpreter\Math\ExpressionImplementations\Division;
use Patterns\Behavioral\Interpreter\Math\ExpressionImplementations\Multiply;
use Patterns\Behavioral\Interpreter\Math\ExpressionImplementations\Sum;
use Patterns\Behavioral\Interpreter\Math\ExpressionImplementations\Value;
use Webit\Util\EvalMath\EvalMath;

class Evaluator
{
    private $_rawExpression;

    public function __construct($rawExpression)
    {
        $this->_rawExpression = $rawExpression;
    }

    public function evaluate()
    {
        return $this->_makeTree()->evaluate();
    }

    private function _getRpnExpression($rawExpression)
    {
        return implode(' ', (new EvalMath())->nfx($rawExpression));
    }

    /**
     * @return ExpressionInterface
     * @throws Exception
     */
    private function _makeTree()
    {
        $stack = array();

        $token = strtok($this->_getRpnExpression($this->_rawExpression), ' ');

        while ($token !== false) {
            if (in_array($token, array('*', '/', '+', '-'))) {
                $_right = array_pop($stack);
                $_left = array_pop($stack);

                $expression = null;

                switch ($token) {
                    case '*':
                        $expression = new Multiply($_left, $_right);
                        break;
                    case '/':
                        $expression = new Division($_left, $_right);
                        break;
                    case '+':
                        $expression = new Sum($_left, $_right);
                        break;
                    case '-':
                        $expression = new Difference($_left, $_right);
                        break;
                }

                array_push($stack, $expression);
            } elseif (is_numeric($token)) {
                array_push($stack, new Value($token));
            }

            $token = strtok(' ');
        }

        return array_pop($stack);
    }
}