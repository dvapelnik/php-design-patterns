<?php
namespace Patterns\Structural\Proxy\FS;

class TextFile extends AbstractFile
{
    protected function _readFileContent()
    {
        $this->_fileContent = phpversion();
    }
}