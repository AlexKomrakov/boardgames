<?php

namespace boardgames\events;


/**
 * User: komrakov
 * Date: 08.12.16
 * Time: 22:50
 */
interface ListenerInterface
{

    public function listen(EventInterface $event);
    public function getEventName(): string;

}