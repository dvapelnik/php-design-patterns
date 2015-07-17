<?php
namespace Patterns\Behavioral\ChainOfResponsibility\HelpInfo\CompositionImplementation;

class ValidHelpHandler implements HelpHandlerInterface
{
    /** @var  HelpHandlerInterface */
    private $_nextHelpHandler;

    private $_helpData = 'HELP_DATA_ON_VALID_HELP_HANDLER';

    private $_defaultHelpData = 'DEFAULT_HELP_DATA_ON_VALID_HELP_HANDLER';

    public function getHelpInfo()
    {
        if ($this->_helpData) {
            return $this->_helpData;
        } elseif ($this->_nextHelpHandler) {
            return $this->_nextHelpHandler->getHelpInfo();
        } else {
            return $this->_defaultHelpData;
        }
    }

    public function setNextHelpHandler(HelpHandlerInterface $nextHelpHandler)
    {
        $this->_nextHelpHandler = $nextHelpHandler;
    }
}