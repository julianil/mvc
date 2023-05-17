<?php

namespace App\Repository;

use Doctrine\Persistence\ManagerRegistry;
use App\Repository\ProductRepository;

use PHPUnit\Framework\TestCase;

/**
 * Test cases för klassen Product.
 */
class ProductRepositoryTest extends TestCase
{
    /**
     * Skapar ett objekt och kontrollerar att det skapas.
     */
    public function testCreateProduct()
    {
        $manager = $this->createMock(ManagerRegistry::class);
        $product = new ProductRepository($manager);
        $this->assertInstanceOf("App\Repository\ProductRepository", $product);

        $this->assertIsObject($product);
    }
}
