<?php

namespace boardgames\events;


/**
 * User: komrakov
 * Date: 08.12.16
 * Time: 23:22
 */
abstract class AbstractEvent implements EventInterface
{

    public function getName(): string
    {
        return static::class;
    }

}