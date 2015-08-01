<?php
namespace PatternsTests\Behavioral\Strategy\Person;

use Patterns\Behavioral\Strategy\Person\Person;
use PHPUnit_Framework_TestCase;
use ReflectionClass;
use ReflectionProperty;

class PersonTest extends PHPUnit_Framework_TestCase
{
    private $_fullName = 'Foo Bar';

    private $_className = '\Patterns\Behavioral\Strategy\Person\Person';

    /** @var  ReflectionProperty */
    private $_reflectedSexProp;

    /** @var  ReflectionProperty */
    private $_reflectedFullNameProp;

    /** @var  ReflectionProperty */
    private $_reflectedAppealStrategyProp;

    public function setUp()
    {
        $this->_reflectedSexProp = new ReflectionProperty($this->_className, '_sex');
        $this->_reflectedSexProp->setAccessible(true);

        $this->_reflectedFullNameProp = new ReflectionProperty($this->_className, '_fullName');
        $this->_reflectedFullNameProp->setAccessible(true);

        $this->_reflectedAppealStrategyProp = new ReflectionProperty($this->_className, '_appealStrategy');
        $this->_reflectedAppealStrategyProp->setAccessible(true);

        // Drop old singleton instances
        $reflectedInstancesProp = new ReflectionProperty(
            '\Patterns\Behavioral\Strategy\Person\AbstractAppealStrategy',
            '_instances');
        $reflectedInstancesProp->setAccessible(true);
        $reflectedInstancesProp->setValue(array());
    }

    public function correctSexValuesProvider()
    {
        return array(
            array(
                'sex'                   => Person::PERSON_SEX_FEMALE,
                'expectedClassStrategy' => '\Patterns\Behavioral\Strategy\Person\FemaleAppealStrategy',
                'expectedAppealPrefix'  => 'Ms. ',
            ),
            array(
                'sex'                   => Person::PERSON_SEX_MALE,
                'expectedClassStrategy' => '\Patterns\Behavioral\Strategy\Person\MaleAppealStrategy',
                'expectedAppealPrefix'  => 'Mr. ',
            ),
        );
    }

    /**
     * @dataProvider correctSexValuesProvider
     */
    public function testConstructor($sex, $expectedClassStrategy)
    {
        $person = new Person($sex, $this->_fullName);

        $this->assertEquals(
            $sex,
            $this->_reflectedSexProp->getValue($person));

        $this->assertEquals(
            $this->_fullName,
            $this->_reflectedFullNameProp->getValue($person));

        $this->assertInstanceOf(
            $expectedClassStrategy,
            $this->_reflectedAppealStrategyProp->getValue($person));
    }

    public function testConstructorWithException()
    {
        $wrongSexValue = -1;

        $this->setExpectedException('Exception', "Sex value '$wrongSexValue' is not supported");

        $person = new Person($wrongSexValue, $this->_fullName);
    }

    /**
     * @dataProvider correctSexValuesProvider
     */
    public function testGetAppeal($sex, $expectedClassStrategy, $expectedAppealPrefix)
    {
        $person = new Person($sex, $this->_fullName);

        $this->assertEquals($expectedAppealPrefix . $this->_fullName, $person->getAppeal());
    }

    /**
     * @test
     */
    public function workExample()
    {
        $johnDoe = new Person(Person::PERSON_SEX_MALE, 'John Doe');
        $this->assertEquals('Mr. John Doe', $johnDoe->getAppeal());

        $judyDoe = new Person(Person::PERSON_SEX_FEMALE, 'Judy Doe');
        $this->assertEquals('Ms. Judy Doe', $judyDoe->getAppeal());
    }
}