<?php
namespace Patterns\Structural\Proxy\FS\ProtectionProxy;

use Patterns\Structural\Proxy\FS\ProtectionProxy\Accessors\AbstractAccessor;
use Patterns\Structural\Proxy\FS\ProtectionProxy\Exceptions\AccessForbiddenException;
use Patterns\Structural\Proxy\FS\TextFile;

class TextFileProxy extends TextFile
{
    private function _checkAccessor(AbstractAccessor $accessor)
    {
        return $accessor->canAccess();
    }

    public function getFileContent($accessor = null)
    {
        if ($this->_checkAccessor($accessor)) {
            return parent::getFileContent();
        } else {
            throw new AccessForbiddenException();
        }
    }
}