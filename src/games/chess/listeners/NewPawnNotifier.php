<?php

namespace boardgames\games\chess\listeners;


use boardgames\events\EventInterface;
use boardgames\events\ListenerInterface;
use boardgames\games\chess\events\BeforeAddFigureEvent;
use boardgames\games\chess\figures\Pawn;

/**
 * User: komrakov
 * Date: 08.12.16
 * Time: 23:27
 */
class NewPawnNotifier implements ListenerInterface
{

    /**
     * @param BeforeAddFigureEvent|EventInterface $event
     */
    public function listen(EventInterface $event)
    {
        if ($event->figure instanceof Pawn) {
            $position = $event->position->getX() . $event->position->getY();
            $name = $event->figure->getName();

            echo '"' . $name . '" добавлена на позицию ' . $position . PHP_EOL;
        }
    }

    /**
     * @return string
     */
    public function getEventName(): string
    {
        return BeforeAddFigureEvent::class;
    }

}