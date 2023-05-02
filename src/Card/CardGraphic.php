<?php

namespace App\Card;

class CardGraphic extends Card
{
    private $representation = [
        'Klöver',
        'Spader',
        'Hjärter',
        'Ruter',
    ];

    public function __construct()
    {
        parent::__construct();
    }

    public function getAsString(): string
    {
        $cardColor = $this->color;
        if ($cardColor == "♣") {
            $color = 1;
        } elseif ($cardColor == "♠") {
            $color = 2;
        } elseif ($cardColor == "♥") {
            $color = 3;
        } elseif ($cardColor == "♦") {
            $color = 4;
        }
        if (isset($color)) {
            return "{$this->representation[$color - 1]} {$this->value}";
        }
        return "No color {$this->value}";
    }
}
