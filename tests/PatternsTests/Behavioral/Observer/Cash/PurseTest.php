<?php
namespace PatternsTests\Behavioral\Observer\Cash;

use Patterns\Behavioral\Observer\Cash\Purse;
use PHPUnit_Framework_TestCase;
use ReflectionClass;
use ReflectionProperty;
use SplObjectStorage;

class PurseTest extends PHPUnit_Framework_TestCase
{
    /** @var  ReflectionProperty */
    private $_reflectedObserverObjectListProp;

    /** @var  ReflectionProperty */
    private $_reflectedCashAmountProp;

    private $_simplePurseDisplayMock;

    public function setUp()
    {
        $this->_reflectedCashAmountProp = new ReflectionProperty(
            '\Patterns\Behavioral\Observer\Cash\Purse',
            '_cashAmount');
        $this->_reflectedCashAmountProp->setAccessible(true);

        $this->_reflectedObserverObjectListProp = new ReflectionProperty(
            '\Patterns\Behavioral\Observer\Cash\Purse',
            '_observerObjectList');
        $this->_reflectedObserverObjectListProp->setAccessible(true);

        $this->_simplePurseDisplayMock =
            $this->getMockBuilder('\Patterns\Behavioral\Observer\Cash\SimplePurseDisplay')
                ->disableOriginalConstructor()
                ->getMock();
    }

    public function testConstructor()
    {
        $purse = new Purse();

        /** @var SplObjectStorage $observerObjectList */
        $observerObjectList = $this->_reflectedObserverObjectListProp->getValue($purse);

        $this->assertNotNull($observerObjectList);
        $this->assertEquals(0, count($observerObjectList));

        $this->assertEquals(0, $this->_reflectedCashAmountProp->getValue($purse));

        return $purse;
    }

    /**
     * @depends testConstructor
     */
    public function testGetCashAmount(Purse $purse)
    {
        $beginValueOfAmountOfCash = $this->_reflectedCashAmountProp->getValue($purse);

        $this->assertEquals(
            $beginValueOfAmountOfCash,
            $purse->getCashAmount());

        $newCashAmountValue = 100;

        $this->_reflectedCashAmountProp->setValue($purse, $newCashAmountValue);

        $this->assertEquals($newCashAmountValue, $purse->getCashAmount());

        $this->_reflectedCashAmountProp->setValue($purse, $beginValueOfAmountOfCash);
    }

    /**
     * @depends testConstructor
     */
    public function testAddCash(Purse $purse)
    {
        $beginCashAmount = $purse->getCashAmount();

        $additionCashAmount = 10;

        $purse->addCash($additionCashAmount);

        $this->assertEquals(
            $beginCashAmount + $additionCashAmount,
            $this->_reflectedCashAmountProp->getValue($purse));
        $this->assertEquals(
            $beginCashAmount + $additionCashAmount,
            $purse->getCashAmount());

        $this->_reflectedCashAmountProp->setValue($purse, null);

        $purse->addCash($additionCashAmount);

        $this->assertEquals($additionCashAmount, $this->_reflectedCashAmountProp->getValue($purse));
        $this->assertEquals($additionCashAmount, $purse->getCashAmount());
    }

    /**
     * @depends testConstructor
     */
    public function testAttachAndDetach(Purse $purse)
    {
        $countOnBeginOfTest = count($this->_reflectedObserverObjectListProp->getValue($purse));

        $purse->attach($this->_simplePurseDisplayMock);

        $this->assertEquals(
            $countOnBeginOfTest + 1,
            count($this->_reflectedObserverObjectListProp->getValue($purse)));

        $purse->detach($this->_simplePurseDisplayMock);

        $this->assertEquals(
            $countOnBeginOfTest,
            count($this->_reflectedObserverObjectListProp->getValue($purse)));
    }
}