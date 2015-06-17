<?php
namespace Maze\Map;

interface MapSiteInterface
{
    public function Enter();

    public static function GetDirectionVerbose($direction);
}