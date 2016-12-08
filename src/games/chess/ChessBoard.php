<?php

namespace boardgames\games\chess;


use boardgames\AbstractBoard;
use boardgames\BoardInterface;
use boardgames\events\DispatcherInterface;
use boardgames\events\HasDispatcherInterface;
use boardgames\games\chess\events\BeforeAddFigureEvent;
use boardgames\games\chess\exceptions\InvalidPositionException;
use boardgames\games\chess\exceptions\NoFigureException;
use boardgames\StorageInterface;

/**
 * User: komrakov
 * Date: 07.12.16
 * Time: 11:08
 */
class ChessBoard extends AbstractBoard implements ChessBoardInterface, HasDispatcherInterface
{

    /**
     * @var array
     */
    private $board = [];

    /**
     * @var DispatcherInterface
     */
    private $dispatcher;

    /**
     * ChessBoard constructor.
     *
     * @param StorageInterface $storage
     * @param DispatcherInterface $dispatcher
     */
    public function __construct(StorageInterface $storage, DispatcherInterface $dispatcher)
    {
        $this->setDispatcher($dispatcher);

        parent::__construct($storage);
    }

    /**
     * @param FigureInterface $figure
     * @param PositionInterface $position
     *
     * @return ChessBoardInterface
     */
    public function addFigure(FigureInterface $figure, PositionInterface $position): ChessBoardInterface
    {
        $this->getDispatcher()->trigger(new BeforeAddFigureEvent($figure, $position, $this));

        $this->validatePosition($position);
        $x = $position->getX();
        $y = $position->getY();
        $this->board[$x][$y] = $figure;

        return $this;
    }

    /**
     * @param PositionInterface $position
     *
     * @return FigureInterface
     *
     * @throws NoFigureException
     */
    public function deleteFigure(PositionInterface $position): FigureInterface
    {
        $x = $position->getX();
        $y = $position->getY();
        $figure = $this->getFigure($position);
        if (empty($figure)) {
            throw new NoFigureException("No figure on position $x-$y");
        }

        unset($this->board[$x][$y]);

        return $figure;
    }

    /**
     * @param PositionInterface $positionStart
     * @param PositionInterface $positionEnd
     *
     * @throws NoFigureException
     */
    public function moveFigure(PositionInterface $positionStart, PositionInterface $positionEnd)
    {
        $this->validatePosition($positionEnd);
        $figure = $this->deleteFigure($positionStart);
        $this->addFigure($figure, $positionEnd);
    }

    /**
     * @param PositionInterface $position
     *
     * @return null|FigureInterface
     */
    public function getFigure(PositionInterface $position)
    {
        $this->validatePosition($position);
        $x = $position->getX();
        $y = $position->getY();

        return empty($this->board[$x][$y]) ? null : $this->board[$x][$y];
    }

    /**
     * @param PositionInterface $position
     *
     * @throws InvalidPositionException
     */
    public function validatePosition(PositionInterface $position)
    {
        $x = $position->getX();
        $y = $position->getY();
        $coordsX = $this->getCoordsX();
        $coordsY = $this->getCoordsY();

        if (!in_array($x, $coordsX) || !in_array($y, $coordsY)) {
            throw new InvalidPositionException("Invalid position with coords $x-$y");
        }
    }

    /**
     * Возвращает массив допустимых координат по оси X
     *
     * @return array
     */
    public function getCoordsX(): array
    {
        return str_split('abcdefgh');
    }

    /**
     * Возвращает массив допустимых координат по оси Y
     *
     * @return array
     */
    public function getCoordsY(): array
    {
        return str_split('12345678');
    }

    /**
     * @return string
     */
    public function toString(): string
    {
        return serialize($this->board);
    }

    /**
     * FIXME Добавить обработку ошибок при неудачной десериализации
     *
     * @param $string
     *
     * @return BoardInterface
     */
    public function fromString($string): BoardInterface
    {
        $this->board = unserialize($string);

        return $this;
    }

    /**
     * @return DispatcherInterface
     */
    public function getDispatcher(): DispatcherInterface
    {
        return $this->dispatcher;
    }

    /**
     * @param DispatcherInterface $dispatcher
     */
    public function setDispatcher(DispatcherInterface $dispatcher)
    {
        $this->dispatcher = $dispatcher;
    }

}