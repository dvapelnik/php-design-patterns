<?php
namespace PatternsTests\Behavioral\Mediator\Cash;

use Patterns\Behavioral\Mediator\Cash\CurrencySelector;
use PHPUnit_Framework_TestCase;
use ReflectionClass;
use ReflectionProperty;

class CurrencySelectorTest extends PHPUnit_Framework_TestCase
{
    /** @var  ReflectionProperty */
    private $_reflectedDirectorProp;

    /** @var  ReflectionProperty */
    private $_reflectedCurrentCurrencyProp;

    private $_className = '\Patterns\Behavioral\Mediator\Cash\CurrencySelector';

    public function setUp()
    {
        $this->_reflectedDirectorProp = new ReflectionProperty($this->_className, '_director');
        $this->_reflectedDirectorProp->setAccessible(true);

        $this->_reflectedCurrentCurrencyProp = new ReflectionProperty($this->_className, '_currentCurrency');
        $this->_reflectedCurrentCurrencyProp->setAccessible(true);
    }

    public function testConstructor()
    {
        $reflectedCurrencyDirectorClass = new ReflectionClass(
            '\Patterns\Behavioral\Mediator\Cash\CurrencyDirector');

        $director = $reflectedCurrencyDirectorClass->newInstanceWithoutConstructor();

        $currencySelector = new CurrencySelector($director);

        $this->assertSame($director, $this->_reflectedDirectorProp->getValue($currencySelector));

        return $currencySelector;
    }

    /**
     * @depends testConstructor
     *
     * @param CurrencySelector $currencySelector
     */
    public function testCurrentCashGetterAndSetter($currencySelector)
    {
        $directorStub = $this->getMockBuilder('\Patterns\Behavioral\Mediator\Cash\CurrencyDirector')
            ->disableOriginalConstructor()
            ->getMock();

        $this->_reflectedDirectorProp->setValue($currencySelector, $directorStub);

        foreach (array('foo', 'bar', 'baz', 'beez') as $currency) {
            $currencySelector->setCurrentCurrency($currency);
            $this->assertEquals($currency, $this->_reflectedCurrentCurrencyProp->getValue($currencySelector));
            $this->assertEquals($currency, $currencySelector->getCurrentCurrency());
        }
    }
}