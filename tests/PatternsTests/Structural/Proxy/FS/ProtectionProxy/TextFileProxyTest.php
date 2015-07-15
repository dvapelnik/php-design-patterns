<?php
namespace PatternsTests\Structural\Proxy\FS\ProtectionProxy;

use Patterns\Structural\Proxy\FS\ProtectionProxy\Accessors\AbstractAccessor;
use Patterns\Structural\Proxy\FS\ProtectionProxy\TextFileProxy;
use ReflectionMethod;
use ReflectionProperty;

class TextFileProxyTest extends AbstractProtectionProxyTest
{
    private $_fileName;

    /** @var  TextFileProxy */
    private $_textFileProxy;

    public function setUp()
    {
        $this->_fileName = '/path/to/file';

        $this->_textFileProxy = new TextFileProxy($this->_fileName);
    }

    /**
     * @dataProvider accessorClassesProvider
     */
    public function testCheckAccessor($accessorClassName, $canAccessValue)
    {
        /** @var AbstractAccessor $accessor */
        $accessor = new $accessorClassName($this->_textFileProxy);

        $reflectedCheckAccessorMethod =
            new ReflectionMethod(
                '\Patterns\Structural\Proxy\FS\ProtectionProxy\TextFileProxy',
                '_checkAccessor');
        $reflectedCheckAccessorMethod->setAccessible(true);

        $this->assertEquals(
            $canAccessValue,
            $reflectedCheckAccessorMethod->invoke(
                $this->_textFileProxy,
                $accessor));
    }

    /**
     * @dataProvider accessorClassesProvider
     */
    public function testGetFileContent($accessorClassName, $canAccessValue)
    {
        if ($canAccessValue === false) {
            $this->setExpectedException(
                '\Patterns\Structural\Proxy\FS\ProtectionProxy\Exceptions\AccessForbiddenException');
        }

        $reflectedFileContentProperty =
            new ReflectionProperty(
                '\Patterns\Structural\Proxy\FS\ProtectionProxy\TextFileProxy',
                '_fileContent');
        $reflectedFileContentProperty->setAccessible(true);

        $this->assertEquals(
            $reflectedFileContentProperty->getValue($this->_textFileProxy),
            $this->_textFileProxy->getFileContent(
                new $accessorClassName($this->_textFileProxy)));
    }
}