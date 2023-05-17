<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Test cases for Game controller.
 */

class LuckyControllerGameTest extends WebTestCase
{
    /**
     * Testar att routen /game laddas korrekt och med rätt template.
     */
    public function testGameInit(): void
    {
        $client = static::createClient();

        $client->request('GET', '/game');

        $this->assertSelectorTextContains('h1', 'Spel: 21');
    }

    /**
     * Testar att routen /game/doc laddas korrekt och med rätt template.
     */
    public function testCardGame(): void
    {
        $client = static::createClient();

        $client->request('GET', '/game/doc');

        $this->assertSelectorTextContains('h1', 'Spel dokumentation');
    }
}
