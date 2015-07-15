<?php
namespace Patterns\Structural\Proxy\FS\VirtualProxy;

use Patterns\Structural\Proxy\FS\TextFile;

class TextFileProxy extends TextFile
{
    function __construct($fileName)
    {
        $this->_fileName = $fileName;
    }

    public function getFileContent()
    {
        if ($this->_fileContent === null) {
            $this->_readFileContent();
        }

        return $this->_fileContent;
    }
}