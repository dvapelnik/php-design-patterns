<?php
namespace PatternsTests\Behavioral\Strategy\Printer;

use Patterns\Behavioral\Strategy\Printer\Source;
use Patterns\Behavioral\Strategy\Printer\SquareBracketWrappedPrintStrategy;
use Patterns\Behavioral\Strategy\Printer\TripleDottedWrappedPrintStrategy;
use PHPUnit_Framework_TestCase;
use ReflectionProperty;

class SourceTest extends PHPUnit_Framework_TestCase
{
    /** @var  ReflectionProperty */
    private $_reflectedTextProp;

    /** @var  ReflectionProperty */
    private $_reflectedPrintStrategyProp;

    private $_text = 'Foo Bar';

    private $_printStrategyClasses = array(
        array(
            'className'    => '\Patterns\Behavioral\Strategy\Printer\SquareBracketWrappedPrintStrategy',
            'printPattern' => '[%s]',
        ),
        array(
            'className'    => '\Patterns\Behavioral\Strategy\Printer\TripleDottedWrappedPrintStrategy',
            'printPattern' => '...%s...',
        ),
    );

    public function setUp()
    {
        $this->_reflectedTextProp = new ReflectionProperty(
            '\Patterns\Behavioral\Strategy\Printer\Source',
            '_text');
        $this->_reflectedTextProp->setAccessible(true);

        $this->_reflectedPrintStrategyProp = new ReflectionProperty(
            '\Patterns\Behavioral\Strategy\Printer\Source',
            '_printStrategy');
        $this->_reflectedPrintStrategyProp->setAccessible(true);
    }

    public function testConstructor()
    {
        $source = new Source($this->_text);

        $this->assertEquals($this->_text, $this->_reflectedTextProp->getValue($source));

        return $source;
    }

    /**
     * @param Source $source
     *
     * @depends testConstructor
     * @return Source
     */
    public function testSetPrintStrategy($source)
    {
        foreach ($this->_printStrategyClasses as $printStrategyArray) {
            $printStrategy = new $printStrategyArray['className'];

            $source->setPrintStrategy($printStrategy);

            $this->assertSame($printStrategy, $this->_reflectedPrintStrategyProp->getValue($source));
        }

        $source->setPrintStrategy(null);
        $this->assertNull($this->_reflectedPrintStrategyProp->getValue($source));

        return $source;
    }

    /**
     * @param Source $source
     *
     * @depends testConstructor
     */
    public function testGetFormattedText($source)
    {
        foreach ($this->_printStrategyClasses as $printStrategyArray) {
            $source->setPrintStrategy(new $printStrategyArray['className']);

            $this->assertEquals(
                sprintf($printStrategyArray['printPattern'], $this->_text),
                $source->getFormattedText());
        }

        $source->setPrintStrategy(null);

        $this->assertEquals($this->_text, $source->getFormattedText());
    }

    /**
     * @test
     */
    public function workExample()
    {
        $source = new Source('Foo Bar');
        $this->assertEquals('Foo Bar', $source->getFormattedText());

        $source->setPrintStrategy(new SquareBracketWrappedPrintStrategy());
        $this->assertEquals('[Foo Bar]', $source->getFormattedText());

        $source->setPrintStrategy(new TripleDottedWrappedPrintStrategy());
        $this->assertEquals('...Foo Bar...', $source->getFormattedText());
    }
}