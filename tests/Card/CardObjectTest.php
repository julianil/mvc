<?php

namespace App\Card;

use PHPUnit\Framework\TestCase;

/**
 * Test case för klassen Card.
 */
class CardObjectTest extends TestCase
{
    /**
     * Skapar ett Card-objekt att kör getAsString() funktionen utan att ge
     * objeket några värden, kontrollerar så returen är en sträng.
     */
    public function testStringReturned()
    {
        $card = new Card();
        $this->assertInstanceOf("\App\Card\Card", $card);

        $this->assertIsString($card->getAsString());
    }
    /**
     * Skapar ett card-objekt testar att det går att lägga till värden till detta
     * med hjälp av addValue() funktionen.
     */
    public function testAddValue()
    {
        $card = new Card();
        $this->assertInstanceOf("\App\Card\Card", $card);

        $res = $card->addValues(3, "♦");
        $exp = array(3, "♦");
        $this->assertSame($exp, $res);
    }
    /**
     * Skapar ett card-objekt testar att det går att lägga till värden till detta
     * med hjälp av drawCard() funktionen.
     */
    public function testDrawCard()
    {
        $card = new Card();
        $this->assertInstanceOf("\App\Card\Card", $card);

        $this->assertNotEmpty($card->drawCard());
    }
    /**
     * Skapar fyra card-objekt och testar att det går att lägga till värden till dessa
     * med hjälp av drawCard() funktionen.
     */
    public function testDrawCards()
    {
        $card1 = new Card();
        $this->assertInstanceOf("\App\Card\Card", $card1);
        $card2 = new Card();
        $this->assertInstanceOf("\App\Card\Card", $card2);
        $card3 = new Card();
        $this->assertInstanceOf("\App\Card\Card", $card3);
        $card4 = new Card();
        $this->assertInstanceOf("\App\Card\Card", $card4);

        $card1->drawCard();
        $card2->drawCard();
        $card3->drawCard();
        $card4->drawCard();

        $this->assertNotEmpty($card1);
        $this->assertNotEmpty($card2);
        $this->assertNotEmpty($card3);
        $this->assertNotEmpty($card4);
    }
    /**
     * Skapar ett card-objekt och ger det ett värde, kontrollerar att rätt värde
     * sätts och retuneras när getVaule() anropas.
     */
    public function testgetValue()
    {
        $card = new Card();
        $this->assertInstanceOf("\App\Card\Card", $card);

        $card->addValues(3, "♦");
        $res = $card->getValue();
        $exp = 3;
        $this->assertSame($exp, $res);
    }
    /**
     * Skapar ett card-objekt och ger det ett värde, kontrollerar att rätt värde
     * sätts och retuneras när getVauleString() anropas.
     */
    public function testgetValueString()
    {
        $card = new Card();
        $this->assertInstanceOf("\App\Card\Card", $card);

        $card->addValues(3, "♦");
        $res = $card->getValueString();
        $exp = "3";
        $this->assertSame($exp, $res);
    }
    /**
     * Skapar ett card-objekt och ger det ett värde, kontrollerar att rätt värde
     * sätts och retuneras när getColor() anropas.
     */
    public function testgetColor()
    {
        $card = new Card();
        $this->assertInstanceOf("\App\Card\Card", $card);

        $card->addValues(3, "♦");
        $res = $card->getColor();
        $exp = "♦";
        $this->assertSame($exp, $res);
    }
    /**
     * Skapar ett card-objekt och ett deck-objekt. Testar sedan att drawCardDeck() funktionen
     * fungerar som tänkt och att card-objektet får ett värde.
     */
    public function testDrawCardDeck()
    {
        $deck = new DeckOfCards();
        $this->assertInstanceOf("\App\Card\DeckOfCards", $deck);
        $card = new Card();
        $this->assertInstanceOf("\App\Card\Card", $card);

        $deck->addCards();
        $this->assertNotEmpty($card->drawCardDeck($deck->getString()));
    }
}
