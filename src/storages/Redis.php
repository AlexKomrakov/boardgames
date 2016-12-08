<?php

namespace boardgames\storages;


use boardgames\StorageInterface;
use Predis\Client;
use Predis\ClientInterface;

/**
 * User: komrakov
 * Date: 06.12.16
 * Time: 22:21
 */
class Redis implements StorageInterface
{

    /**
     * @var \Redis
     */
    public $client;

    /**
     * Redis constructor.
     *
     * @param Client $redis
     */
    public function __construct(Client $redis)
    {
        $this->client = $redis;
    }

    /**
     * @param $string
     * @param $key
     *
     * @return bool
     */
    public function save($key, $string): bool
    {
        return (bool) $this->client->set($key, $string);
    }

    /**
     * @param $key
     *
     * @return string
     */
    public function load($key): string
    {
        return (string) $this->client->get($key);
    }

}