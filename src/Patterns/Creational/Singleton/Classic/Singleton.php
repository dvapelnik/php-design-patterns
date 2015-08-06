<?php
namespace Patterns\Creational\Singleton\Classic;

class Singleton implements SingletonInterface
{
    protected static $_instances;

    /**
     * @return static
     */
    public static function GetInstance()
    {
        $calledClass = get_called_class();

        if (!isset(self::$_instances[$calledClass])) {
            self::$_instances[$calledClass] = new $calledClass();
        }

        return self::$_instances[$calledClass];
    }

    protected function __construct()
    {
    }

    final private function __clone()
    {
    }

    final private function __wakeup()
    {
    }
}