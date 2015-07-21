<?php
namespace Patterns\Behavioral\Command\PrintCommand;

use Patterns\Behavioral\Command\CommandInterface;

class Printer implements CommandInterface
{
    protected $_text;

    public function __construct($text)
    {
        $this->_text = $text;
    }

    public function execute()
    {
        if ($this->_text) {
            echo $this->_text;
        } else {
            echo '';
        }
    }
}