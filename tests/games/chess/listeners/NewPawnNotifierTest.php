<?php

namespace boardgames\games\chess\listeners;


use boardgames\events\Dispatcher;
use boardgames\games\chess\ChessBoard;
use boardgames\games\chess\figures\Pawn;
use boardgames\games\chess\figures\Queen;
use boardgames\games\chess\Position;
use boardgames\storages\File;
use PHPUnit\Framework\TestCase;

/**
 * User: komrakov
 * Date: 08.12.16
 * Time: 23:41
 *
 * @coversDefaultClass boardgames\games\chess\listeners\NewPawnNotifier
 */
class NewPawnNotifierTest extends TestCase
{

    /**
     * @covers ::listen
     */
    public function testListen()
    {
        $storage = new File();
        $dispatcher = new Dispatcher();
        $board =  new ChessBoard($storage, $dispatcher);
        $listener = new NewPawnNotifier();
        $board->getDispatcher()->attach($listener);
        $this->expectOutputString("");

        $pawn = new Queen();
        $position = new Position('e', '2');
        $board->addFigure($pawn, $position);
        $this->expectOutputString("");

        $pawn = new Pawn();
        $position = new Position('e', '3');
        $board->addFigure($pawn, $position);
        $this->expectOutputString('"Пешка" добавлена на позицию e3' . PHP_EOL);
    }

}