<?php

namespace App\Controller;

use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Test cases for Game controller.
 */

class LuckyControllerGameTest extends WebTestCase
{
    /**
     * Testar att routen /game laddas korrekt och med rätt template.
     */
    public function testGameInit()
    {
        $client = static::createClient();

        $client->request('GET', '/game');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Spel: 21');
    }

    /**
     * Testar att routen /game/doc laddas korrekt och med rätt template.
     */
    public function testCardGame()
    {
        $client = static::createClient();

        $client->request('GET', '/game/doc');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Spel dokumentation');
    }
}
