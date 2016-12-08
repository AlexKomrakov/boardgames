<?php

namespace boardgames\games\chess\events;


use boardgames\BoardInterface;
use boardgames\events\AbstractEvent;
use boardgames\games\chess\FigureInterface;
use boardgames\games\chess\PositionInterface;

/**
 * User: komrakov
 * Date: 08.12.16
 * Time: 23:21
 */
class BeforeAddFigureEvent extends AbstractEvent
{

    /**
     * @var PositionInterface
     */
    public $position;

    /**
     * @var FigureInterface
     */
    public $figure;

    /**
     * @var BoardInterface
     */
    public $board;

    public function __construct(FigureInterface $figure, PositionInterface $position, BoardInterface $board)
    {
        $this->figure   = $figure;
        $this->position = $position;
        $this->board    = $board;
    }

}