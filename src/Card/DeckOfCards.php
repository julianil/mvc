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
        $last_card = end($hand)[$lenght-1];
        foreach ($this->deck as $card) {
            if ($card->getValueString() === $last_card->getValueString() AND $card->getColor() === $last_card->getColor()) {
                $key = array_search($card, $this->deck);
                unset($this->deck[$key]);
            }
        }
        //foreach ($deckArray as $card) {
            //$this->deck[] = $card;
        //}
        //return $this->deck;
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
