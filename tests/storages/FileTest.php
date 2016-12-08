<?php

namespace boardgames\storages;


use PHPUnit\Framework\TestCase;

/**
 * User: komrakov
 * Date: 08.12.16
 * Time: 21:36
 *
 * @coversDefaultClass boardgames\storages\File
 */
class FileTest extends TestCase
{

    /**
     * @covers ::save
     * @covers ::load
     */
    public function testSave()
    {
        $storage = new File();
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