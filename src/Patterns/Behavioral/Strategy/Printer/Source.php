<?php
namespace Patterns\Behavioral\Strategy\Printer;

class Source
{
    /** @var  AbstractPrintStrategy|null */
    private $_printStrategy;

    private $_text;

    /**
     * Source constructor.
     *
     * @param $_text
     */
    public function __construct($_text)
    {
        $this->_text = $_text;
    }

    /**
     * @return string
     * @throws \Exception
     */
    public function getFormattedText()
    {
        return $this->_printStrategy === null
            ? $this->_text
            : $this->_printStrategy->getFormattedString($this->_text);
    }

    /**
     * @param null|AbstractPrintStrategy $printerStrategy
     */
    public function setPrintStrategy($printerStrategy)
    {
        $this->_printStrategy = $printerStrategy;
    }
}