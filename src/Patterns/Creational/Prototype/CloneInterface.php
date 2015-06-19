<?php
namespace Patterns\Creational\Prototype;

interface CloneInterface
{
    public function makeClone();

    public function initialize($options = array());
}