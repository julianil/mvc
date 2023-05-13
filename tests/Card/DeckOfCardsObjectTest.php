<?php

namespace App\Card;

use PHPUnit\Framework\TestCase;

/**
 * Test cases för klassen DeckOfCards.
 */
class DeckOfCardsObjectTest extends TestCase
{
    /**
     * Skapar två DeckOfCards-objekt och adderar 52 card-objekt som sorteras efterfärg och storlek.
     * Blandar det ena DeckOfCards-objektet med shuffleDeck() funktionen, kontrollera så att
     * DeckOfCards-objekten inte längre är likadana.
     */
    public function testShuffleDeck()
    {
        $deck1 = new DeckOfCards();
        $this->assertInstanceOf("\App\Card\DeckOfCards", $deck1);
        $deck2 = new DeckOfCards();
        $this->assertInstanceOf("\App\Card\DeckOfCards", $deck2);

        $deck1->addCards();
        $deck2->addCards();
        $deck2->shuffleDeck();
        $this->assertNotEquals($deck1->getString(), $deck2->getString());
    }
    /**
     * Skapar ett DeckOfCards-objekt och adderar 52 kort-objekt, kontrollera
     * att rätt antal kort-objekt skapas.
     */
    public function testNumberCards()
    {
        $deck = new DeckOfCards();
        $this->assertInstanceOf("\App\Card\DeckOfCards", $deck);

        $deck->addCards();
        $this->assertSame(52, $deck->getNumberCards());
    }
    /**
     * Skapar ett DeckOfCards-objekt och adderar 52 kort-objekt. Skapar hand-objekt och adderar
     * ett card-objekt med värde. Kör funktionen updateDeck() och kontrollerar så att DeckOfCards-objeket
     * inte längre innehåller de card-objekt som lagts i hand-objektet.
     */
    public function testUpdateDeck()
    {
        $hand = new CardHand();
        $this->assertInstanceOf("\App\Card\CardHand", $hand);
        $deck = new DeckOfCards();
        $this->assertInstanceOf("\App\Card\DeckOfCards", $deck);
        $card = new Card();
        $this->assertInstanceOf("\App\Card\Card", $card);

        $deck->addCards();
        $card->addValues("J", "♠");
        $hand->add($card);
        $deck->updateDeck($deck->getString(), $hand->getString());
        $this->assertNotContains("J ♠", $deck->getString());
    }
}
