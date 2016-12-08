<?php

namespace boardgames;


/**
 * User: komrakov
 * Date: 06.12.16
 * Time: 22:22
 */
interface StorageInterface
{

    public function save($key, $string): bool;
    public function load($key): string ;

}