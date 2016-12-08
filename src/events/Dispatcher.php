<?php

namespace boardgames\events;


use SplObjectStorage;

/**
 * User: komrakov
 * Date: 08.12.16
 * Time: 22:43
 */
class Dispatcher implements DispatcherInterface
{

    /**
     * @var SplObjectStorage[]
     */
    private $listeners = [];

    /**
     * @param EventInterface $event
     */
    public function trigger(EventInterface $event)
    {
        $name = $event->getName();
        $listeners = $this->getListenersStorage($name);
        foreach ($listeners as $listener) {
            $listener->listen($event);
        }
    }

    /**
     * @param ListenerInterface $listener
     */
    public function attach(ListenerInterface $listener)
    {
        $name = $listener->getEventName();
        $this->getListenersStorage($name)->attach($listener);
    }

    /**
     * @param ListenerInterface $listener
     */
    public function detach(ListenerInterface $listener)
    {
        $name = $listener->getEventName();
        $this->getListenersStorage($name)->detach($listener);
    }

    /**
     * FIXME Не создавать пустые SplObjectStorage если это не требуется
     *
     * @param $name
     *
     * @return SplObjectStorage
     */
    private function getListenersStorage($name): SplObjectStorage
    {
        $this->listeners[$name] = empty($this->listeners[$name]) ? new SplObjectStorage() : $this->listeners[$name];

        return $this->listeners[$name];
    }

}