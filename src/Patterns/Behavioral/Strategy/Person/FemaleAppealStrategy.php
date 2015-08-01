<?php
namespace Patterns\Behavioral\Strategy\Person;

class FemaleAppealStrategy extends AbstractAppealStrategy
{
    protected $_appealNamePrefix = 'Ms. ';
}