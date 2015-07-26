<?php
namespace Patterns\Behavioral\Iterator;

interface PassiveIteratorInterface
{
    public function __construct(IteratorInterface $iterator);

    public function traverse();
}