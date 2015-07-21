<?php
namespace Patterns\Behavioral\Command;

class Executor
{
    /** @var  CommandInterface */
    private $_command;

    /**
     * @param CommandInterface $command
     */
    public function setCommand($command)
    {
        $this->_command = $command;
    }

    public function commandRun()
    {
        $this->_command->execute();
    }
}