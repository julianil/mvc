<?php

namespace App\Repository;

use Doctrine\Persistence\ManagerRegistry;
use App\Repository\LibraryRepository;

use PHPUnit\Framework\TestCase;

/**
 * Test cases för klassen Library.
 */
class LibraryRepositoryTest extends TestCase
{
    /**
     * Skapar ett objekt och kontrollerar att det skapas.
     */
    public function testCreateLibrary()
    {
        $manager = $this->createMock(ManagerRegistry::class);
        $book = new LibraryRepository($manager);
        $this->assertInstanceOf("App\Repository\LibraryRepository", $book);

        $this->assertIsObject($book);
    }
}
