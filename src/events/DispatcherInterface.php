<?php

namespace boardgames\events;

/**
 * User: komrakov
 * Date: 08.12.16
 * Time: 22:43
 */
interface DispatcherInterface
{

    public function attach(ListenerInterface $listener);
    public function detach(ListenerInterface $listener);
    public function trigger(EventInterface $event);

}