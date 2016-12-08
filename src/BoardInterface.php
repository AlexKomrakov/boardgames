<?php

namespace boardgames;


/**
 * User: komrakov
 * Date: 06.12.16
 * Time: 22:29
 */
interface BoardInterface
{

    public function toString(): string;
    public function fromString($string): BoardInterface;

}