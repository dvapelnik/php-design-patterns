<?php
namespace Patterns\Behavioral\Strategy\Person;

use Exception;
use Patterns\Creational\Singleton\Classic\SingletonTrait;

abstract class AbstractAppealStrategy
{
    use SingletonTrait;

    protected $_appealNamePrefix;

    /**
     * @return mixed
     * @throws Exception
     */
    public function getAppealNamePrefix()
    {
        if ($this->_appealNamePrefix === null) {
            throw new Exception(get_class($this) . "::_appealNamePrefix must be implemented on extended class");
        }

        return $this->_appealNamePrefix;
    }
}