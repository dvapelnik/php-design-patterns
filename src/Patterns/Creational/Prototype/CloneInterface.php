<?php
namespace Patterns\Creational\Prototype;

interface CloneInterface extends InitializeInterface
{
    public function makeClone();
}