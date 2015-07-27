<?php
namespace PatternsTests\Behavioral\Mediator\Cash;

use Patterns\Behavioral\Mediator\Cash\CurrencyDirector;
use PHPUnit_Framework_TestCase;
use ReflectionProperty;

class CurrencyDirectorTest extends PHPUnit_Framework_TestCase
{
    private $_className = '\Patterns\Behavioral\Mediator\Cash\CurrencyDirector';

    /** @var  ReflectionProperty */
    private $_reflectedCashProp;

    /** @var  ReflectionProperty */
    private $_reflectedCurrencySelectorProp;

    /** @var  ReflectionProperty */
    private $_reflectedCurrencyRatesProp;

    /** @var  ReflectionProperty */
    private $_reflectedCashAmountInDefaultCurrencyProp;

    /** @var  ReflectionProperty */
    private $_reflectedDefaultCurrencyProp;

    public function setUp()
    {
        $this->_reflectedCashProp =
            new ReflectionProperty($this->_className, '_cash');
        $this->_reflectedCashProp->setAccessible(true);

        $this->_reflectedCurrencySelectorProp =
            new ReflectionProperty($this->_className, '_currencySelector');
        $this->_reflectedCurrencySelectorProp->setAccessible(true);

        $this->_reflectedCurrencyRatesProp =
            new ReflectionProperty($this->_className, '_currencyRates');
        $this->_reflectedCurrencyRatesProp->setAccessible(true);

        $this->_reflectedCashAmountInDefaultCurrencyProp =
            new ReflectionProperty($this->_className, '_cashAmountInDefaultCurrency');
        $this->_reflectedCashAmountInDefaultCurrencyProp->setAccessible(true);

        $this->_reflectedDefaultCurrencyProp =
            new ReflectionProperty($this->_className, '_defaultCurrency');
        $this->_reflectedDefaultCurrencyProp->setAccessible(true);
    }

    private $_currencyRates = array(
        'USD' => 1,
        'EUR' => 3,
    );

    private $_cashAmountInDefaultCurrency = 10;

    private $_defaultCurrency = 'USD';

    public function testConstructor()
    {
        $director = new CurrencyDirector(
            $this->_currencyRates,
            $this->_cashAmountInDefaultCurrency,
            $this->_defaultCurrency);

        $this->assertEquals(
            $this->_currencyRates,
            $this->_reflectedCurrencyRatesProp->getValue($director));

        $this->assertEquals(
            $this->_cashAmountInDefaultCurrency,
            $this->_reflectedCashAmountInDefaultCurrencyProp->getValue($director));

        $this->assertEquals(
            $this->_defaultCurrency,
            $this->_reflectedDefaultCurrencyProp->getValue($director));

        $this->assertNotNull($this->_reflectedCashProp->getValue($director));
        $this->assertNotNull($this->_reflectedCurrencySelectorProp->getValue($director));

        return $director;
    }

    /**
     * @depends testConstructor
     *
     * @param CurrencyDirector $director
     */
    public function testGetCash($director)
    {
        $this->assertSame(
            $this->_reflectedCashProp->getValue($director),
            $director->getCash());
    }

    /**
     * @depends testConstructor
     *
     * @param CurrencyDirector $director
     */
    public function testGetCurrencySelector($director)
    {
        $this->assertSame(
            $this->_reflectedCurrencySelectorProp->getValue($director),
            $director->getCurrencySelector());
    }

    /**
     * @depends testConstructor
     *
     * @param CurrencyDirector $director
     */
    public function testSetCurrencyInCurrencySelector($director)
    {
        $this->assertEquals(
            $this->_defaultCurrency,
            $director->getCurrencySelector()->getCurrentCurrency());
    }

    /**
     * @depends testConstructor
     *
     * @param CurrencyDirector $director
     */
    public function testSetAmountInCash($director)
    {
        $this->assertEquals(
            $this->_cashAmountInDefaultCurrency,
            $director->getCash()->getCurrentCash());
    }

    /**
     * @depends testConstructor
     *
     * @param CurrencyDirector $director
     */
    public function testSetCurrencyViaCurrencySelector($director)
    {
        $cash = $director->getCash();
        $currencySelector = $director->getCurrencySelector();

        $currencySelector->setCurrentCurrency('EUR');

        $this->assertEquals(
            $this->_cashAmountInDefaultCurrency * $this->_currencyRates['EUR'],
            $cash->getCurrentCash());
    }
}