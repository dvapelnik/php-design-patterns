<?php
namespace Patterns\Structural\Proxy\FS;

abstract class AbstractFile
{
    protected $_fileName;

    protected $_fileContent;

    public function __construct($fileName)
    {
        $this->_fileName = $fileName;

        $this->_readFileContent();
    }

    abstract protected function _readFileContent();

    public function getFileContent()
    {
        return $this->_fileContent;
    }
}