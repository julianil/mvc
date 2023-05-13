<?php

namespace App\Card;

use PHPUnit\Framework\TestCase;

/**
 * Test cases för klassen CardGraphic.
 */
class CardGraphicObjectTest extends TestCase
{
    /**
     * Skapar ett CardGraphic-objekt att kör getAsString() funktionen utan att ge
     * objeket några värden, kontrollerar så returen är en sträng.
     */
    public function testgetAsStringNoValue()
    {
        $card = new CardGraphic();
        $this->assertInstanceOf("\App\Card\CardGraphic", $card);

        $this->assertIsString($card->getAsString());
    }
    /**
     * Skapar ett CardGraphic-objekt och ger de ett nummer samt värdet Ruter. Testkör getAsString() funktionen
     * och kontrollerar att rätt sträng retuneras.
     */
    public function testgetAsStringValueRuter()
    {
        $card = new CardGraphic();
        $this->assertInstanceOf("\App\Card\CardGraphic", $card);

        $card->addValues(3, "♦");
        $res = $card->getAsString();
        $exp = "Ruter 3";
        $this->assertSame($exp, $res);
    }
    /**
     *  Skapar ett CardGraphic-objekt och ger de ett nummer samt värdet Spader. Testkör getAsString() funktionen
     * och kontrollerar att rätt sträng retuneras.
     */
    public function testgetAsStringValueSpader()
    {
        $card = new CardGraphic();
        $this->assertInstanceOf("\App\Card\CardGraphic", $card);

        $card->addValues(6, "♠");
        $res = $card->getAsString();
        $exp = "Spader 6";
        $this->assertSame($exp, $res);
    }
    /**
     *  Skapar ett CardGraphic-objekt och ger de ett nummer samt värdet Hjärter. Testkör getAsString() funktionen
     * och kontrollerar att rätt sträng retuneras.
     */
    public function testgetAsStringValueHjarter()
    {
        $card = new CardGraphic();
        $this->assertInstanceOf("\App\Card\CardGraphic", $card);

        $card->addValues(10, "♥");
        $res = $card->getAsString();
        $exp = "Hjärter 10";
        $this->assertSame($exp, $res);
    }
    /**
     *  Skapar ett CardGraphic-objekt och ger de ett nummer samt värdet Klöver. Testkör getAsString() funktionen
     * och kontrollerar att rätt sträng retuneras.
     */
    public function testgetAsStringValueKlover()
    {
        $card = new CardGraphic();
        $this->assertInstanceOf("\App\Card\CardGraphic", $card);

        $card->addValues("A", "♣");
        $res = $card->getAsString();
        $exp = "Klöver A";
        $this->assertSame($exp, $res);
    }
}
