<?php
namespace Patterns\Behavioral\Command\PrintCommand;

use Patterns\Behavioral\Command\CommandInterface;

class MacroCommand implements CommandInterface
{
    /** @var  CommandInterface[] */
    private $_commands;

    /**
     * MacroCommand constructor.
     */
    public function __construct()
    {
        $this->_commands = array();
    }

    public function addCommand(CommandInterface $command)
    {
        $this->_commands[] = $command;
    }

    public function getCommands()
    {
        return $this->_commands;
    }

    public function removeCommand($index)
    {
        $result = false;

        if (isset($this->_commands[$index])) {
            $result = $this->_commands[$index];

            unset($this->_commands[$index]);
        }

        return $result;
    }

    public function eraseCommands()
    {
        $this->_commands = array();
    }

    public function execute()
    {
        foreach ($this->_commands as $_command) {
            $_command->execute();
        }
    }
}