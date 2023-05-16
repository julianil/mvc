<?php

namespace App\Entity;

use PHPUnit\Framework\TestCase;

/**
 * Test cases för klassen Product.
 */

class ProductEntityTest extends TestCase
{
    /**
     * Skapar ett objekt och kontrollerar att det skapas.
     */
    public function testSetGetProduct()
    {
        $product = new Product();
        $this->assertInstanceOf("App\Entity\Product", $product);

        $product->setName("Kakor");
        $product->setValue(100);

        $this->assertIsObject($product);
        $this->assertStringContainsString("Kakor", $product->getName());
        $this->assertStringContainsString(100, $product->getValue());
    }
}
