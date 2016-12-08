<?php

namespace boardgames;


/**
 * User: komrakov
 * Date: 06.12.16
 * Time: 22:19
 */
abstract class AbstractBoard implements BoardInterface
{

    /**
     * @var StorageInterface
     */
    private $storage;

    public function __construct(StorageInterface $storage)
    {
        $this->setStorage($storage);
    }

    /**
     * @param StorageInterface $storage
     */
    public function setStorage(StorageInterface $storage)
    {
        $this->storage = $storage;
    }

    /**
     * @param $key
     *
     * @return bool
     */
    public function save($key)
    {
        $string = $this->toString();

        return $this->getStorage()->save($key, $string);
    }

    /**
     * @param $key
     *
     * @return BoardInterface
     */
    public function load($key)
    {
        $string = $this->getStorage()->load($key);

        return $this->fromString($string);
    }

    /**
     * @return StorageInterface
     */
    public function getStorage()
    {
        return $this->storage;
    }

}