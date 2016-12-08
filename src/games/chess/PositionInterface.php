<?php

namespace boardgames\games\chess;


/**
 * User: komrakov
 * Date: 07.12.16
 * Time: 11:59
 */
interface PositionInterface
{

    public function getX(): string;
    public function getY(): string;

}