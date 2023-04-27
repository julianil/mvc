<?php

namespace App\Card;

class Card
{
    protected $value;
    protected $color;

    public function __construct()
    {
        $this->value = null;
        $this->color = null;
    }

    public function draw_card(): array
    {
        $value = random_int(1, 13);
        if ($value == 1) {
            $this->value = "A";
        } elseif ($value == 11) {
            $this->value = "J";
        } elseif ($value == 12) {
            $this->value = "Q";
        } elseif ($value == 13) {
            $this->value = "K";
        } else {
            $this->value = $value;
        }

        $color = random_int(1, 4);
        if ($color == 1) {
            $this->color = "♣";
        } elseif ($color == 2) {
            $this->color = "♠";
        } elseif ($color == 3) {
            $this->color = "♥";
        } elseif ($color == 4) {
            $this->color = "♦";
        }

        return array($this->value, $this->color);
    }

    public function add_values($card_value, $card_color): array
    {
        $this->value = $card_value;
        $this->color = $card_color;

        return array($this->value, $this->color);
    }

    public function getValue(): int
    {
        return $this->value;
    }

    public function getColor(): string
    {
        return $this->color;
    }

    public function getAsString(): string
    {
        return "{$this->value} {$this->color}";
    }
}
