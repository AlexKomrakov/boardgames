<?php

namespace boardgames\games\chess\figures;


use boardgames\games\chess\FigureInterface;

/**
 * User: komrakov
 * Date: 06.12.16
 * Time: 22:20
 */
class Queen implements FigureInterface
{

    public function getName(): string
    {
        return 'Ферзь';
    }

}