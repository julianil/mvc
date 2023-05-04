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

    public function drawCard(): void
    {
        foreach ($this->hand as $card) {
            $card->drawCard();
        }
    }

    public function drawOneCard(): void
    {
        end($this->hand)->drawCard();
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
            } elseif ($points == "A") {
                $points = 1;
            }
            $score += intval($points);
        }
        return $score;
    }

    public function bankHand($hand): void
    {
        while ($hand->getScoreHand() < 15) {
            $hand->add(new Card());
            $hand->drawOneCard();
        }
    }

    public function getWinner($player, $bank): string
    {
        $winner = "";
        $playerScore = $player->getScoreHand();
        $bankScore = $bank->getScoreHand();
        if ($playerScore === $bankScore or $playerScore > 21) {
            $winner = "bank";
        } else {
            $winner = "player";
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
