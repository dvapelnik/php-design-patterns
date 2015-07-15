<?php
namespace PatternsTests\Structural\Proxy\FS\ProtectionProxy;

use PHPUnit_Framework_TestCase;

abstract class AbstractProtectionProxyTest extends PHPUnit_Framework_TestCase
{
    public function accessorClassesProvider()
    {
        return array(
            array(
                'className'      => '\Patterns\Structural\Proxy\FS\ProtectionProxy\Accessors\ValidAccessor',
                'canAccessValue' => true,
            ),
            array(
                'className'      => '\Patterns\Structural\Proxy\FS\ProtectionProxy\Accessors\InvalidAccessor',
                'canAccessValue' => false,
            ),
        );
    }
}