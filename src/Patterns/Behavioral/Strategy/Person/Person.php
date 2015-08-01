<?php
namespace Patterns\Behavioral\Strategy\Person;

use Exception;

class Person
{
    const PERSON_SEX_FEMALE = 0;
    const PERSON_SEX_MALE = 1;

    private $_sex;

    private $_fullName;

    /** @var AbstractAppealStrategy */
    private $_appealStrategy;

    /**
     * Person constructor.
     *
     * @param $_sex
     * @param $_fullName
     *
     * @throws Exception
     */
    public function __construct($_sex, $_fullName)
    {
        if (in_array($_sex, array(static::PERSON_SEX_FEMALE, static::PERSON_SEX_MALE,))) {
            $this->_sex = $_sex;

            if ($_sex == 0) {
                $appealStrategy = FemaleAppealStrategy::getInstance();
            } else {
                $appealStrategy = MaleAppealStrategy::getInstance();
            }

            $this->_appealStrategy = $appealStrategy;
        } else {
            throw new Exception("Sex value '$_sex' is not supported");
        }

        $this->_fullName = $_fullName;
    }

    public function getAppeal()
    {
        return $this->_appealStrategy->getAppealNamePrefix() . $this->_fullName;
    }
}