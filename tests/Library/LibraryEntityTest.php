<?php

namespace App\Entity;

use PHPUnit\Framework\TestCase;

/**
 * Test cases för klassen Library.
 */

class LibraryEntityTest extends TestCase
{
    /**
     * Skapar ett objekt och kontrollerar att det skapas.
     */
    public function testSetGetLibrary()
    {
        $book = new Library();
        $this->assertInstanceOf("App\Entity\Library", $book);

        $book->setName("Bamse");
        $book->setIsbn("9482058205");
        $book->setWriter("Lille Skutt");
        $book->setImage("bild.com");
        $book->setDescription("Det var en gång en liten");

        $this->assertIsObject($book);
        $this->assertStringContainsString("Bamse", $book->getName());
        $this->assertStringContainsString("9482058205", $book->getIsbn());
        $this->assertStringContainsString("Lille Skutt", $book->getWriter());
        $this->assertStringContainsString("bild.com", $book->getImage());
        $this->assertStringContainsString("Det var en gång en liten", $book->getDescription());
    }
}
