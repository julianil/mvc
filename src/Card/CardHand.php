<?php

namespace App\Card;

use App\Card\Card;

class CardHand
{
    private $hand = [];

    public function add(Card $card): void
    {
        $this->hand[] = $card;
    }

    public function drawCard($deck): void
    {
        $deckLenght = $deck->getNumberCards();
        
        foreach ($this->hand as $card) {
            $deck_array = $deck->getString();
            $cardValue = $deck_array[random_int(0, $deckLenght - 1)];
            $card->addValues($cardValue[0], $cardValue[2]);
        }
    }

    public function getNumberCards(): int
    {
        return count($this->hand);
    }

    public function getValues(): array
    {
        $values = [];
        foreach ($this->hand as $card) {
            $values[] = $card->getValue();
        }
        return $values;
    }

    public function getScoreHand(): int
    {
        $score = 0;
        foreach ($this->hand as $card) {
            $points = $card->getValueString();
            if ($points == "J") {
                $points = 11;
            } elseif ($points == "Q") {
                $points = 12;
            } elseif ($points == "K") {
                $points = 13;
            }
            $score += intval($points);
        }
        return $score;
    }

    public function getString(): array
    {
        $values = [];
        foreach ($this->hand as $card) {
            $values[] = $card->getAsString();
        }
        return $values;
    }
}
