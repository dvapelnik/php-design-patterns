<?php
namespace PatternsTests\Behavioral\Observer\Cash;

use Patterns\Behavioral\Observer\Cash\Purse;
use Patterns\Behavioral\Observer\Cash\SimplePurseDisplay;
use PHPUnit_Framework_TestCase;

class WorkExampleTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function work()
    {
        $additionCashAmount = 100;

        $purse = new Purse();

        $simplePurseDisplay = new SimplePurseDisplay($purse);

        $this->assertEquals(
            $purse->getCashAmount(),
            $simplePurseDisplay->getCashAmountOnPurse());

        $purse->addCash($additionCashAmount);

        $this->assertNotEquals(
            $purse->getCashAmount(),
            $simplePurseDisplay->getCashAmountOnPurse());

        $purse->notify();

        $this->assertEquals(
            $additionCashAmount,
            $purse->getCashAmount());
        $this->assertEquals(
            $additionCashAmount,
            $simplePurseDisplay->getCashAmountOnPurse());
        $this->assertEquals(
            $purse->getCashAmount(),
            $simplePurseDisplay->getCashAmountOnPurse());
    }
}