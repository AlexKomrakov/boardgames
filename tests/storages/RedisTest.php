<?php

namespace boardgames\storages;


use PHPUnit\Framework\TestCase;
use Predis\Client;

/**
 * User: komrakov
 * Date: 08.12.16
 * Time: 21:37
 *
 * @coversDefaultClass boardgames\storages\Redis
 */
class RedisTest extends TestCase
{

    /**
     * @covers ::save
     * @covers ::load
     */
    public function testSave()
    {
        $client = new Client([
            'host' => getenv('REDIS_HOST') ?: 'localhost'
        ]);
        $storage = new Redis($client);
        $string = 'test';
        $key = __DIR__ . '/temp/temp.txt';
        $result = $storage->save($key, $string);
        $this->assertTrue($result);

        $loaded = $storage->load($key);
        $this->assertEquals($string, $loaded);

        $loaded = $storage->load('not_existing_key');
        $this->assertEmpty($loaded);
    }

}