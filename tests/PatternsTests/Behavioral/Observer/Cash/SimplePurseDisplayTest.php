<?php
namespace PatternsTests\Behavioral\Observer\Cash;

use Patterns\Behavioral\Observer\Cash\Purse;
use Patterns\Behavioral\Observer\Cash\SimplePurseDisplay;
use PHPUnit_Framework_TestCase;

class SimplePurseDisplayTest extends PHPUnit_Framework_TestCase
{
    /** @var  \ReflectionProperty */
    private $_reflectedPurseProp;

    /** @var  \ReflectionProperty */
    private $_reflectedCashAmountOnPurseProp;

    public function setUp()
    {
        $this->_reflectedPurseProp = new \ReflectionProperty(
            '\Patterns\Behavioral\Observer\Cash\SimplePurseDisplay',
            '_purse');
        $this->_reflectedPurseProp->setAccessible(true);

        $this->_reflectedCashAmountOnPurseProp = new \ReflectionProperty(
            '\Patterns\Behavioral\Observer\Cash\SimplePurseDisplay',
            '_cashAmountOnPurse');
        $this->_reflectedCashAmountOnPurseProp->setAccessible(true);
    }

    public function testConstructor()
    {
        $purse = new Purse();

        $simplePurseDisplay = new SimplePurseDisplay($purse);

        $this->assertSame($purse, $this->_reflectedPurseProp->getValue($simplePurseDisplay));
        $this->assertEquals(0, $this->_reflectedCashAmountOnPurseProp->getValue($simplePurseDisplay));

        return $simplePurseDisplay;
    }

    /**
     * @depends testConstructor
     */
    public function testGetCashAmountOnPurse(SimplePurseDisplay $simplePurseDisplay)
    {
        $this->assertEquals(
            $this->_reflectedCashAmountOnPurseProp->getValue($simplePurseDisplay),
            $simplePurseDisplay->getCashAmountOnPurse());
    }
}