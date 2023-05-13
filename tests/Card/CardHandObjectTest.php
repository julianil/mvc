<?php

namespace App\Card;

use PHPUnit\Framework\TestCase;

/**
 * Test cases för klassen CardHand.
 */
class CardHandObjectTest extends TestCase
{
    /**
     * Skapar ett hand-objekt och adderar ett antal card-objekt, kontrollera
     * att rätt antal kort-objekt skapas.
     */
    public function testGetNumberCards()
    {
        $hand = new CardHand();
        $this->assertInstanceOf("\App\Card\CardHand", $hand);
        $deck = new DeckOfCards();
        $this->assertInstanceOf("\App\Card\DeckOfCards", $deck);

        $deck->addCards();
        $hand->add(new Card());
        $hand->add(new Card());
        $hand->add(new Card());
        $hand->add(new Card());
        $hand->add(new Card());
        $hand->drawCard($deck->getString());
        $this->assertSame(5, $hand->getNumberCards());
    }
    /**
     * Testar så att funktionen bankHand() genererar en hand med kort.
     */
    public function testBankHand()
    {
        $hand = new CardHand();
        $this->assertInstanceOf("\App\Card\CardHand", $hand);
        $deck = new DeckOfCards();
        $this->assertInstanceOf("\App\Card\DeckOfCards", $deck);

        $deck->addCards();
        $hand->bankHand($hand, $deck);
        $this->assertNotEmpty($hand);
    }
    /**
     * Testar så att funktionen getWinner retunerar rätt värde och att värdet är
     * i form av en sträng.
     */
    public function testGetWinner()
    {
        $bank = new CardHand();
        $this->assertInstanceOf("\App\Card\CardHand", $bank);
        $player = new CardHand();
        $this->assertInstanceOf("\App\Card\CardHand", $player);
        $deck = new DeckOfCards();
        $this->assertInstanceOf("\App\Card\DeckOfCards", $deck);
        $card1 = new Card();
        $this->assertInstanceOf("\App\Card\Card", $card1);
        $card2 = new Card();
        $this->assertInstanceOf("\App\Card\Card", $card2);

        $deck->addCards();
        $bank->bankHand($bank, $deck);
        $card1->addValues("K", "♠");
        $player->add($card1);
        $card2->addValues("K", "♦");
        $player->add($card2);
        $this->assertIsString($bank->getWinner($player, $bank));
        $this->assertSame("bank", $bank->getWinner($player, $bank));
    }
    /**
     * F
     * Skapar en hand med 4 card-objekt, testar så funktionen getScoreHand returnerar
     * rätt värde för denna hand med kort.
     */
    public function testGetScoreHand()
    {
        $player = new CardHand();
        $this->assertInstanceOf("\App\Card\CardHand", $player);
        $card1 = new Card();
        $this->assertInstanceOf("\App\Card\Card", $card1);
        $card2 = new Card();
        $this->assertInstanceOf("\App\Card\Card", $card2);
        $card3 = new Card();
        $this->assertInstanceOf("\App\Card\Card", $card3);
        $card4 = new Card();
        $this->assertInstanceOf("\App\Card\Card", $card4);

        $card1->addValues("J", "♠");
        $player->add($card1);
        $card2->addValues("Q", "♦");
        $player->add($card2);
        $card3->addValues("K", "♦");
        $player->add($card3);
        $card4->addValues("A", "♦");
        $player->add($card4);
        $this->assertSame(37, $player->getScoreHand());
    }
}
