<?php

namespace boardgames\games\chess;


use boardgames\BoardInterface;

/**
 * User: komrakov
 * Date: 07.12.16
 * Time: 11:16
 */
interface ChessBoardInterface extends BoardInterface
{

    /**
     * @param FigureInterface $figure
     *
     * @param PositionInterface $position
     *
     * @return ChessBoardInterface
     */
    public function addFigure(FigureInterface $figure, PositionInterface $position): ChessBoardInterface;

    /**
     * @param PositionInterface $position
     *
     * @return FigureInterface
     */
    public function deleteFigure(PositionInterface $position): FigureInterface;

    /**
     * @param PositionInterface $positionStart
     * @param PositionInterface $positionEnd
     */
    public function moveFigure(PositionInterface $positionStart, PositionInterface $positionEnd);

    /**
     * @param PositionInterface $position
     *
     * @return null|FigureInterface
     */
    public function getFigure(PositionInterface $position);

    /**
     * Возвращает массив допустимых координат по оси X
     *
     * @return array
     */
    public function getCoordsX(): array;

    /**
     * Возвращает массив допустимых координат по оси Y
     *
     * @return array
     */
    public function getCoordsY(): array;

}