<?php
namespace PatternsTests\Structural\Proxy\FS\VirtualProxy;

use Patterns\Structural\Proxy\FS\VirtualProxy\TextFileProxy;
use PHPUnit_Framework_TestCase;
use ReflectionClass;
use ReflectionMethod;
use ReflectionProperty;

class TextFileProxyTest extends PHPUnit_Framework_TestCase
{
    private $_fileName;

    /** @var  ReflectionClass */
    private $_reflectedTextFileProxyClass;

    /** @var  ReflectionProperty */
    private $_reflectedTextFileProxyClassFileContentProp;

    /** @var  ReflectionMethod */
    private $_reflectedTextFileProxyReadFileContentMethod;

    public function setUp()
    {
        $this->_fileName = '/path/to/text/file';

        $this->_reflectedTextFileProxyClass =
            new ReflectionClass('\Patterns\Structural\Proxy\FS\VirtualProxy\TextFileProxy');

        $this->_reflectedTextFileProxyClassFileContentProp =
            $this->_reflectedTextFileProxyClass->getProperty('_fileContent');
        $this->_reflectedTextFileProxyClassFileContentProp->setAccessible(true);

        $this->_reflectedTextFileProxyReadFileContentMethod =
            $this->_reflectedTextFileProxyClass->getMethod('_readFileContent');
        $this->_reflectedTextFileProxyReadFileContentMethod->setAccessible(true);
    }

    public function testConstructor()
    {
        $textFileProxy = new TextFileProxy($this->_fileName);

        $this->assertNull(
            $this->_reflectedTextFileProxyClassFileContentProp->getValue($textFileProxy));
    }

    public function testGetFileContent()
    {
        $textFileProxy = new TextFileProxy($this->_fileName);

        $this->assertEquals(
            phpversion(),
            $textFileProxy->getFileContent());

        $this->assertNotNull(
            $this->_reflectedTextFileProxyClassFileContentProp->getValue($textFileProxy));
    }
}