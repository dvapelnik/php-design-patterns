<?php
namespace Patterns\Creational\Singleton;

trait SingletonTrait
{
    protected static $_instances = array();

    /**
     * @return static
     */
    final public static function getInstance()
    {
        $calledClass = get_called_class();

        if (!isset(self::$_instances[$calledClass])) {
            self::$_instances[$calledClass] = new $calledClass();
        }

        return self::$_instances[$calledClass];
    }

    final private function __construct()
    {
    }

    final private function __wakeup()
    {
    }

    final private function __clone()
    {
    }
}