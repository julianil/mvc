<?php

namespace App\Card;

use App\Card\Card;

/**
* DeckOfCards class represents a normal playing deck with 52 cards. The containing methods creates, shuffles
* and updates the deck as the game goes on.
*/

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

    public function updateDeck($deck, $hand): void
    {
        foreach ($hand as $card) {
            if (in_array($card, $deck)) {
                $key = array_search($card, $deck);
                unset($deck[$key]);
            }
        }
        $this->deck = [];
        foreach ($deck as $cardValue) {
            $card = new Card();
            $this->deck[] = $card;
            $card->addValues($cardValue[0], "♣");
            if (str_contains($cardValue, "♠")) {
                $card->addValues($cardValue[0], "♠");
            } elseif (str_contains($cardValue, "♥")) {
                $card->addValues($cardValue[0], "♥");
            } elseif (str_contains($cardValue, "♦")) {
                $card->addValues($cardValue[0], "♦");
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

    public function getString(): array
    {
        $values = [];
        foreach ($this->deck as $card) {
            $values[] = $card->getAsString();
        }
        return $values;
    }
}
