<?php
namespace Patterns\Behavioral\Strategy\Person;

class MaleAppealStrategy extends AbstractAppealStrategy
{
    protected $_appealNamePrefix = 'Mr. ';
}