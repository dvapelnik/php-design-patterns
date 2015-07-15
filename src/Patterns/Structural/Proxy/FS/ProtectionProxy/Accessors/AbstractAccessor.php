<?php
namespace Patterns\Structural\Proxy\FS\ProtectionProxy\Accessors;

use Patterns\Structural\Proxy\FS\AbstractFile;

abstract class AbstractAccessor
{
    protected $_canAccess;

    /** @var AbstractFile */
    protected $_file;

    function __construct(AbstractFile $file)
    {
        $this->_file = $file;
    }

    public function canAccess()
    {
        if ($this->_canAccess === null) {
            throw new PropertyNotImplementedException();
        } else {
            return $this->_canAccess;
        }
    }

    public function getFileContent()
    {
        return $this->_file->getFileContent($this);
    }
}