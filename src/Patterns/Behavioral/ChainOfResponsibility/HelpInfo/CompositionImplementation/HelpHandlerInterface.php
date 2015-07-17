<?php
namespace Patterns\Behavioral\ChainOfResponsibility\HelpInfo\CompositionImplementation;

interface HelpHandlerInterface
{
    public function getHelpInfo();

    public function setNextHelpHandler(HelpHandlerInterface $nextHelpHandler);
}