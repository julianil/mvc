<?php

namespace App\Controller;

use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Test cases for Library controller.
 */

class ProductControllerTest extends WebTestCase
{
    /**
     * Skapar ett objekt och kontrollerar att det skapas.
     */
    public function testProductInit()
    {
        $client = static::createClient();

        $client->request('GET', '/product');

        $this->assertResponseIsSuccessful();
    }
}
