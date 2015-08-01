<?php
namespace PatternsTests\Behavioral\Strategy\Person;

use Patterns\Behavioral\Strategy\Person\AbstractAppealStrategy;
use PHPUnit_Framework_TestCase;
use ReflectionProperty;

class AbstractAppealStrategyTest extends PHPUnit_Framework_TestCase
{
    public function appealStrategyClassProvider()
    {
        return array(
            array(
                'class'          => '\Patterns\Behavioral\Strategy\Person\FemaleAppealStrategy',
                'expectedPrefix' => 'Ms. ',
            ),
            array(
                'class'          => '\Patterns\Behavioral\Strategy\Person\MaleAppealStrategy',
                'expectedPrefix' => 'Mr. ',
            ),
        );
    }

    /**
     * @dataProvider appealStrategyClassProvider
     *
     * @param $class
     * @param $expectedPrefix
     */
    public function testGetAppealNamePrefix($class, $expectedPrefix)
    {
        /** @var AbstractAppealStrategy $appealStrategy */
        $appealStrategy = $class::getInstance();

        $this->assertEquals($expectedPrefix, $appealStrategy->getAppealNamePrefix());
    }

    /**
     * @dataProvider appealStrategyClassProvider
     *
     * @param $class
     * @param $expectedPrefix
     */
    public function testGetAppealNamePrefixWithException($class, $expectedPrefix)
    {
        /** @var AbstractAppealStrategy $appealStrategy */
        $appealStrategy = $class::getInstance();

        $reflectedAppealNamePrefixProp = new ReflectionProperty($class, '_appealNamePrefix');
        $reflectedAppealNamePrefixProp->setAccessible(true);
        $reflectedAppealNamePrefixProp->setValue($appealStrategy, null);

        $this->setExpectedException(
            'Exception',
            preg_replace('/^\\\\/', '', $class . '::_appealNamePrefix must be implemented on extended class'));

        $appealStrategy->getAppealNamePrefix();
    }
}