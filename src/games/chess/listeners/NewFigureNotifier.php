<?php

namespace boardgames\games\chess\listeners;


use boardgames\events\EventInterface;
use boardgames\events\ListenerInterface;
use boardgames\games\chess\events\BeforeAddFigureEvent;

/**
 * User: komrakov
 * Date: 08.12.16
 * Time: 23:27
 */
class NewFigureNotifier implements ListenerInterface
{

    /**
     * @param BeforeAddFigureEvent|EventInterface $event
     */
    public function listen(EventInterface $event)
    {
        $position = $event->position->getX() . $event->position->getY();
        $name = $event->figure->getName();

        echo 'Добавлена новая фигура: "' . $name . '" на позицию ' . $position . PHP_EOL;
    }

    /**
     * @return string
     */
    public function getEventName(): string
    {
        return BeforeAddFigureEvent::class;
    }

}