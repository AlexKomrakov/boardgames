<?php

namespace boardgames\games\chess;


/**
 * User: komrakov
 * Date: 07.12.16
 * Time: 11:17
 */
class Position implements PositionInterface
{

    public function __construct($x, $y)
    {
        $this->x = $x;
        $this->y = $y;
    }

    /**
     * @var string
     */
    private $x;

    /**
     * @var string
     */
    private $y;

    /**
     * @return string
     */
    public function getX(): string
    {
        return $this->x;
    }

    /**
     * @return string
     */
    public function getY(): string
    {
        return $this->y;
    }

}