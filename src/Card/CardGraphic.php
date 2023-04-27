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
        $card_color = $this->color;
        if ($card_color == "♣") {
            $color = 1;
        } elseif ($card_color == "♠") {
            $color = 2;
        } elseif ($card_color == "♥") {
            $color = 3;
        } elseif ($card_color == "♦") {
            $color = 4;
        }
        return "{$this->representation[$color - 1]} {$this->value}";
    }
}
