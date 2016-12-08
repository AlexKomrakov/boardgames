<?php

namespace boardgames\games\chess;


use boardgames\BoardInterface;
use boardgames\events\Dispatcher;
use boardgames\games\chess\figures\Pawn;
use boardgames\storages\File;
use PHPUnit\Framework\TestCase;

/**
 * User: komrakov
 * Date: 08.12.16
 * Time: 18:41
 *
 * @coversDefaultClass boardgames\games\chess\ChessBoard
 */
class ChessBoardTest extends TestCase
{

    /**
     * @covers ::addFigure
     */
    public function testAddFigure()
    {
        $board = $this->getNewBoard();
        $pawn = new Pawn();
        $position = new Position('e', '2');
        $board = $board->addFigure($pawn, $position);
        $this->assertInstanceOf(BoardInterface::class, $board);

        $figure = $board->getFigure($position);
        $this->assertEquals($pawn, $figure);

        return $board;
    }

    /**
     * @covers ::deleteFigure
     */
    public function testDeleteFigure()
    {
        $board = $this->getNewBoard();
        $pawn = new Pawn();
        $position = new Position('e', '2');
        $board->addFigure($pawn, $position);
        $figure = $board->getFigure($position);
        $this->assertEquals($pawn, $figure);

        $figure = $board->deleteFigure($position);
        $this->assertNotEmpty($figure);
        $this->assertInstanceOf(FigureInterface::class, $figure);

        $figure = $board->getFigure($position);
        $this->assertEmpty($figure);
    }

    /**
     * @covers ::moveFigure
     */
    public function testMoveFigure()
    {
        $board = $this->getNewBoard();
        $pawn = new Pawn();
        $position = new Position('e', '2');
        $board->addFigure($pawn, $position);
        $figure = $board->getFigure($position);
        $this->assertEquals($pawn, $figure);

        $newPosition = new Position('e', '4');
        $board->moveFigure($position, $newPosition);

        $figure = $board->getFigure($position);
        $this->assertEmpty($figure);

        $figure = $board->getFigure($newPosition);
        $this->assertNotEmpty($figure);
    }

    /**
     * @covers ::toString
     * @covers ::fromString
     */
    public function testToString()
    {
        $board = $this->getNewBoard();
        $pawn = new Pawn();
        $position = new Position('e', '2');
        $board->addFigure($pawn, $position);

        $figure = $board->getFigure($position);
        $this->assertNotEmpty($figure);

        $string = $board->toString();

        $secondBoard = $this->getNewBoard();
        $figure = $secondBoard->getFigure($position);
        $this->assertEmpty($figure);

        $secondBoard->fromString($string);

        $figure = $secondBoard->getFigure($position);
        $this->assertNotEmpty($figure);
    }

    private function getNewBoard()
    {
        $storage = new File();
        $dispatcher = new Dispatcher();

        return new ChessBoard($storage, $dispatcher);
    }

}