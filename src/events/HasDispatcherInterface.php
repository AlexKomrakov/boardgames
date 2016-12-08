<?php

namespace boardgames\events;


/**
 * User: komrakov
 * Date: 08.12.16
 * Time: 23:16
 */
interface HasDispatcherInterface
{

    public function getDispatcher(): DispatcherInterface;
    public function setDispatcher(DispatcherInterface $dispatcher);

}