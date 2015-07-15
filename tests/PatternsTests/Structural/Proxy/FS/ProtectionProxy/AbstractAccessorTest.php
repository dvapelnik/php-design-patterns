<?php
namespace PatternsTests\Structural\Proxy\FS\ProtectionProxy;

use Patterns\Structural\Proxy\FS\ProtectionProxy\Accessors\AbstractAccessor;
use Patterns\Structural\Proxy\FS\ProtectionProxy\TextFileProxy;
use ReflectionProperty;

class AbstractAccessorTest extends AbstractProtectionProxyTest
{
    private $_fileName;

    private $_textFileProxy;

    public function setUp()
    {
        $this->_fileName = '/path/to/file';

        $this->_textFileProxy = new TextFileProxy($this->_fileName);
    }

    /**
     * @dataProvider accessorClassesProvider
     */
    public function testConstructor($accessorClassName)
    {
        $accessor = new $accessorClassName($this->_textFileProxy);

        $reflectedAccessorFileProperty = new ReflectionProperty($accessorClassName, '_file');
        $reflectedAccessorFileProperty->setAccessible(true);

        $this->assertSame($this->_textFileProxy, $reflectedAccessorFileProperty->getValue($accessor));
    }

    /**
     * @expectedException \Patterns\Structural\Proxy\FS\ProtectionProxy\Accessors\PropertyNotImplementedException
     *
     * @dataProvider accessorClassesProvider
     */
    public function testCanAccessWithException($accessorClassName)
    {
        /** @var AbstractAccessor $accessor */
        $accessor = new $accessorClassName($this->_textFileProxy);

        $reflectedAccessorCanAccessProperty = new ReflectionProperty($accessorClassName, '_canAccess');
        $reflectedAccessorCanAccessProperty->setAccessible(true);
        $reflectedAccessorCanAccessProperty->setValue($accessor, null);

        $accessor->canAccess();
    }

    /**
     * @dataProvider accessorClassesProvider
     */
    public function testCanAccess($accessorClassName, $canAccessValue)
    {
        /** @var AbstractAccessor $accessor */
        $accessor = new $accessorClassName($this->_textFileProxy);

        $this->assertEquals($canAccessValue, $accessor->canAccess());
    }

    /**
     * @dataProvider accessorClassesProvider
     */
    public function testGetFileContent($accessorClassName, $canAccessValue)
    {
        $textFileProxyStub = $this
            ->getMockBuilder('\Patterns\Structural\Proxy\FS\ProtectionProxy\TextFileProxy')
            ->disableOriginalConstructor()
            ->getMock();

        $textFileProxyStub->method('getFileContent')->willReturn(phpversion());

        /** @var AbstractAccessor $accessor */
        $accessor = new $accessorClassName($textFileProxyStub);

        $accessor->getFileContent();
    }
}