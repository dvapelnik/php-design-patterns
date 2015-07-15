<?php
namespace PatternsTests\Structural\Proxy;

use Patterns\Structural\Proxy\FS\TextFile;
use PHPUnit_Framework_TestCase;
use ReflectionClass;
use ReflectionMethod;
use ReflectionProperty;

class TextFileTest extends PHPUnit_Framework_TestCase
{
    private $_fileName;

    /** @var  TextFile */
    private $_textFileInstanceWithoutConstructor;

    /** @var  ReflectionClass */
    private $_reflectedTextFileClass;

    /** @var  ReflectionProperty */
    private $_reflectedTextFileClassFileNameProp;

    /** @var  ReflectionProperty */
    private $_reflectedTextFileClassFileContentProp;

    /** @var  ReflectionMethod */
    private $_reflectedTextFileClassReadFileContentMethod;

    public function setUp()
    {
        $this->_fileName = '/path/to/text/file';

        $this->_reflectedTextFileClass = new ReflectionClass('\Patterns\Structural\Proxy\FS\TextFile');

        $this->_textFileInstanceWithoutConstructor =
            $this->_reflectedTextFileClass->newInstanceWithoutConstructor();

        $this->_reflectedTextFileClassFileNameProp =
            $this->_reflectedTextFileClass->getProperty('_fileName');
        $this->_reflectedTextFileClassFileNameProp->setAccessible(true);

        $this->_reflectedTextFileClassFileContentProp =
            $this->_reflectedTextFileClass->getProperty('_fileContent');
        $this->_reflectedTextFileClassFileContentProp->setAccessible(true);

        $this->_reflectedTextFileClassReadFileContentMethod =
            $this->_reflectedTextFileClass->getMethod('_readFileContent');
        $this->_reflectedTextFileClassReadFileContentMethod->setAccessible(true);
    }

    public function testConstructor()
    {
        $textFile = new TextFile($this->_fileName);

        $this->assertEquals(
            $this->_fileName,
            $this->_reflectedTextFileClassFileNameProp->getValue($textFile));

        $this->assertEquals(
            phpversion(),
            $this->_reflectedTextFileClassFileContentProp->getValue($textFile));
    }

    public function testReadFileContent()
    {
        $this->assertNull(
            $this->_reflectedTextFileClassFileContentProp
                ->getValue($this->_textFileInstanceWithoutConstructor));

        $this->_reflectedTextFileClassReadFileContentMethod
            ->invoke($this->_textFileInstanceWithoutConstructor);

        $this->assertEquals(
            phpversion(),
            $this->_reflectedTextFileClassFileContentProp
                ->getValue($this->_textFileInstanceWithoutConstructor));
    }

    public function testGetFileContent()
    {
        $textFile = new TextFile($this->_fileName);

        $this->assertEquals(
            phpversion(),
            $textFile->getFileContent());
    }
}