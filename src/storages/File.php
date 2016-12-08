<?php

namespace boardgames\storages;


use boardgames\StorageInterface;

/**
 * User: komrakov
 * Date: 06.12.16
 * Time: 22:21
 */
class File implements StorageInterface
{

    /**
     * @param $string
     * @param $key
     *
     * @return bool
     */
    public function save($key, $string): bool
    {
        return (bool) file_put_contents($key, $string);
    }

    /**
     * FIXME Добавить обработку ошибок
     *
     * @param $key
     *
     * @return string
     */
    public function load($key): string
    {
        return @file_get_contents($key);
    }

}