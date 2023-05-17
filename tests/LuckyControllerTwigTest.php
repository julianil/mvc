<?php

namespace App\Controller;

use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Test cases for Twig controller.
 */

class LuckyControllerTwigTest extends WebTestCase
{
    /**
     * Testar att routen /lucky laddas korrekt och med rätt template.
     */
    public function testLucky(): void
    {
        $client = static::createClient();

        $client->request('GET', '/lucky');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Throw the dice');
    }

    /**
     * Testar att routen / laddas korrekt och med rätt template.
     */
    public function testHome()
    {
        $client = static::createClient();

        $client->request('GET', '/');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Home');
    }

    /**
     * Testar att routen /about laddas korrekt och med rätt template.
     */
    public function testAbout()
    {
        $client = static::createClient();

        $client->request('GET', '/about');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'About');
    }

    /**
     * Testar att routen /report laddas korrekt och med rätt template.
     */
    public function testReport()
    {
        $client = static::createClient();

        $client->request('GET', '/report');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Redovisning');
    }

    /**
     * Testar att routen /card laddas korrekt och med rätt template.
     */
    public function testCard()
    {
        $client = static::createClient();

        $client->request('GET', '/card');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Kortspel');
    }

    /**
     * Testar att routen /metrics laddas korrekt och med rätt template.
     */
    public function testMetrics()
    {
        $client = static::createClient();

        $client->request('GET', '/metrics');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Metrics analys');
    }
}
