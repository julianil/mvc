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

    public function drawCard(): array
    {
        $value = random_int(1, 13);
        $this->value = $value;
        if ($value == 1 || $value > 10) {
            if ($value == 1) {
                $this->value = "A";
            } elseif ($value == 11) {
                $this->value = "J";
            } elseif ($value == 12) {
                $this->value = "Q";
            } elseif ($value == 13) {
                $this->value = "K";
            }
        }

        $color = random_int(1, 4);
        $this->color = "♣";
        if ($color == 2) {
            $this->color = "♠";
        } elseif ($color == 3) {
            $this->color = "♥";
        } elseif ($color == 4) {
            $this->color = "♦";
        }

        return array($this->value, $this->color);
    }

    public function drawCardDeck($deck): array
    {
        $key = array_rand($deck);
        $cardValue = $deck[$key];
        $this->color = "♦";
        if (str_contains($cardValue, "♣")) {
            $this->color = "♣";
        } elseif (str_contains($cardValue, "♠")) {
            $this->color = "♠";
        } elseif (str_contains($cardValue, "♥")) {
            $this->color = "♥";
        }

        $this->value = $cardValue[0];

        return array($this->value, $this->color);
    }

    public function addValues($cardValue, $cardColor): array
    {
        $this->value = $cardValue;
        $this->color = $cardColor;

        return array($this->value, $this->color);
    }

    public function getValue(): int
    {
        return $this->value;
    }

    public function getValueString(): string
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
