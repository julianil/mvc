<?php

namespace App\Card;

use App\Card\Card;

class DeckOfCards
{
    private $deck = [];

    public function addCards(): void
    {
        $colors = array("♣", "♣", "♣", "♣", "♣", "♣", "♣", "♣", "♣", "♣", "♣", "♣", "♣", "♠", "♠", "♠", "♠", "♠", "♠", "♠", "♠", "♠", "♠", "♠", "♠", "♠", "♥", "♥", "♥", "♥", "♥", "♥", "♥", "♥", "♥", "♥", "♥", "♥", "♥", "♦", "♦", "♦", "♦", "♦", "♦", "♦", "♦", "♦", "♦", "♦", "♦", "♦");
        $values = array("2", "3", "4", "5", "6", "7", "8", "9", "10", "J", "Q", "K", "A", "2", "3", "4", "5", "6", "7", "8", "9", "10", "J", "Q", "K", "A", "2", "3", "4", "5", "6", "7", "8", "9", "10", "J", "Q", "K", "A", "2", "3", "4", "5", "6", "7", "8", "9", "10", "J", "Q", "K", "A");

        for ($i = 1; $i < 53; $i++) {
            $index = $i - 1;
            $card = new Card();
            $this->deck[] = $card;
            $card->addValues($values[$index], $colors[$index]);
        }
    }

    public function updateDeck($hand): void
    {
        $lenght = $hand->getNumberCards();
        $lastCard = end($hand)[$lenght-1];
        foreach ($this->deck as $card) {
            if ($card->getValueString() === $lastCard->getValueString() and $card->getColor() === $lastCard->getColor()) {
                $key = array_search($card, $this->deck);
                unset($this->deck[$key]);
            }
        }
    }

    public function shuffleDeck(): void
    {
        shuffle($this->deck);
    }

    public function getNumberCards(): int
    {
        return count($this->deck);
    }

    public function getValues(): array
    {
        $values = [];
        foreach ($this->deck as $card) {
            $values[] = $card->getValue();
        }
        return $values;
    }

    public function getString(): array
    {
        $values = [];
        foreach ($this->deck as $card) {
            $values[] = $card->getAsString();
        }
        return $values;
    }
}
