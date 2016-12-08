<?php

namespace boardgames\games\chess\listeners;


use boardgames\events\Dispatcher;
use boardgames\games\chess\ChessBoard;
use boardgames\games\chess\figures\Queen;
use boardgames\games\chess\Position;
use boardgames\storages\File;
use PHPUnit\Framework\TestCase;

/**
 * User: komrakov
 * Date: 08.12.16
 * Time: 23:41
 *
 * @coversDefaultClass boardgames\games\chess\listeners\NewFigureNotifier
 */
class NewFigureNotifierTest extends TestCase
{

    /**
     * @covers ::listen
     */
    public function testListen()
    {
        $storage = new File();
        $dispatcher = new Dispatcher();
        $board =  new ChessBoard($storage, $dispatcher);
        $listener = new NewFigureNotifier();
        $board->getDispatcher()->attach($listener);
        $this->expectOutputString("");

        $pawn = new Queen();
        $position = new Position('e', '2');
        $board->addFigure($pawn, $position);
        $this->expectOutputString('Добавлена новая фигура: "Ферзь" на позицию e2' . PHP_EOL);

        $board->getDispatcher()->detach($listener);
        $pawn = new Queen();
        $position = new Position('e', '3');
        $board->addFigure($pawn, $position);
        $this->expectOutputString('Добавлена новая фигура: "Ферзь" на позицию e2' . PHP_EOL);
    }

}