<?php

namespace App\Controller;

use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Test cases for Library controller.
 */

class LibraryControllerTest extends WebTestCase
{
    /**
     * Testar att routen /library laddas korrekt och med rätt template.
     */
    public function testLibraryInit()
    {
        $client = static::createClient();

        $client->request('GET', '/library');

        $this->assertSelectorTextContains('h1', 'Välkommen till biblioteket!');
    }

    /**
     * Testar att routen /library/create laddas korrekt och med rätt template.
     */
    public function testCreateBook()
    {
        $client = static::createClient();

        $client->request('GET', '/library/create');

        $this->assertSelectorTextContains('h1', 'Ny bok');
    }

    /**
     * Testar att routen /library/show laddas korrekt och med rätt template.
     */
    public function testShowBooks()
    {
        $client = static::createClient();

        $client->request('GET', '/library/show');

        $this->assertSelectorTextContains('h1', 'Alla böcker');
    }
}
