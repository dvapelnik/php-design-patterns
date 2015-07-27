<?php
namespace PatternsTests\Behavioral\Mediator\Cash;

use Patterns\Behavioral\Mediator\Cash\Cash;
use PHPUnit_Framework_TestCase;
use ReflectionClass;
use ReflectionProperty;

class CashTest extends PHPUnit_Framework_TestCase
{
    /** @var  ReflectionProperty */
    private $_reflectedDirectorProp;

    /** @var  ReflectionProperty */
    private $_reflectedCurrentCashProp;

    private $_className = '\Patterns\Behavioral\Mediator\Cash\Cash';

    public function setUp()
    {
        $this->_reflectedDirectorProp = new ReflectionProperty($this->_className, '_director');
        $this->_reflectedDirectorProp->setAccessible(true);

        $this->_reflectedCurrentCashProp = new ReflectionProperty($this->_className, '_currentCash');
        $this->_reflectedCurrentCashProp->setAccessible(true);
    }

    public function testConstructor()
    {
        $reflectedCurrencyDirectorClass = new ReflectionClass(
            '\Patterns\Behavioral\Mediator\Cash\CurrencyDirector');

        $director = $reflectedCurrencyDirectorClass->newInstanceWithoutConstructor();

        $cash = new Cash($director);

        $this->assertSame($director, $this->_reflectedDirectorProp->getValue($cash));

        return $cash;
    }

    /**
     * @depends testConstructor
     *
     * @param Cash $cash
     */
    public function testCurrentCashGetterAndSetter($cash)
    {
        $directorStub = $this->getMockBuilder('\Patterns\Behavioral\Mediator\Cash\CurrencyDirector')
            ->disableOriginalConstructor()
            ->getMock();

        $this->_reflectedDirectorProp->setValue($cash, $directorStub);

        for ($i = 0; $i < 10; $i++) {
            $cash->setCurrentCash($i);
            $this->assertEquals($i, $this->_reflectedCurrentCashProp->getValue($cash));
            $this->assertEquals($i, $cash->getCurrentCash());
        }
    }
}