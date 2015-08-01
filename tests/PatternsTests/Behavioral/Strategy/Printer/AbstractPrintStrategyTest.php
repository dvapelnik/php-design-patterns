<?php
namespace PatternsTests\Behavioral\Strategy\Printer;

use Patterns\Behavioral\Strategy\Printer\AbstractPrintStrategy;
use PHPUnit_Framework_TestCase;

class AbstractPrintStrategyTest extends PHPUnit_Framework_TestCase
{
    private $_string = 'Foo Bar';

    public function printStrategyClassProvider()
    {
        return array(
            array(
                'className'    => '\Patterns\Behavioral\Strategy\Printer\SquareBracketWrappedPrintStrategy',
                'printPattern' => '[%s]',
            ),
            array(
                'className'    => '\Patterns\Behavioral\Strategy\Printer\TripleDottedWrappedPrintStrategy',
                'printPattern' => '...%s...',
            ),
        );
    }

    /**
     * @param $className
     * @param $printPattern
     *
     * @dataProvider printStrategyClassProvider
     */
    public function testGetFormattedString($className, $printPattern)
    {
        /** @var AbstractPrintStrategy $printStrategy */
        $printStrategy = new $className;

        $this->assertEquals(
            sprintf($printPattern, $this->_string),
            $printStrategy->getFormattedString($this->_string));
    }

    /**
     * @param $className
     *
     * @dataProvider printStrategyClassProvider
     *
     * @expectedException \Exception
     * @expectedExceptionMessage '_printPattern' should be reassign with not-null value on extended class
     */
    public function testGetFormattedStringWithException($className)
    {
        /** @var AbstractPrintStrategy $printStrategy */
        $printStrategy = new $className;

        $reflectedPrintPatternProp = new \ReflectionProperty($className, '_printPattern');
        $reflectedPrintPatternProp->setAccessible(true);
        $reflectedPrintPatternProp->setValue($printStrategy, null);

        $printStrategy->getFormattedString($this->_string);
    }
}