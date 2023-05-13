<?php

namespace App\Card;

use App\Card\Card;

/**
* CardHand class represents a hand which can be filled with cards from the deck. The class also contains
* methods necessary for playing the card game, one for counting the hands totalscore, one for drawing the
* banks hand and one for naming the winner.
*/

class CardHand
{
    private $hand = [];

    public function add(Card $card): void
    {
        $this->hand[] = $card;
    }

    public function drawCard($deck): void
    {
        foreach ($this->hand as $card) {
            $card->drawCardDeck($deck);
        }
    }

    public function drawOneCard($deck): void
    {
        end($this->hand)->drawCardDeck($deck);
    }

    public function getNumberCards(): int
    {
        return count($this->hand);
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
            } elseif ($points == "A") {
                $points = 1;
            }
            $score += intval($points);
        }
        return $score;
    }

    public function bankHand($hand, $deck): void
    {
        while ($hand->getScoreHand() < 15) {
            $hand->add(new Card());
            $hand->drawOneCard($deck->getString());
        }
    }

    public function getWinner($player, $bank): string
    {
        $winner = "player";
        $playerScore = $player->getScoreHand();
        $bankScore = $bank->getScoreHand();
        if ($playerScore === $bankScore or $playerScore > 21) {
            $winner = "bank";
        }
        return $winner;
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
