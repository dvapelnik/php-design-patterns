<?php
namespace Patterns\Behavioral\Command\PrintCommand;

use Patterns\Behavioral\Command\CommandInterface;

class SquareBracketsPrinterDecorator implements CommandInterface
{
    /** @var  CommandInterface */
    private $_command;

    /**
     * SquareBracketsPrinterDecorator constructor.
     *
     * @param CommandInterface $_command
     */
    public function __construct(CommandInterface $_command)
    {
        $this->_command = $_command;
    }

    public function execute()
    {
        echo '[';
        $this->_command->execute();
        echo ']';
    }
}